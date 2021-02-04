<?php

namespace App\Http\Controllers;

use App\Enums\State;
use App\Helpers\Expires;
use App\Helpers\Highlighter;
use App\Http\Requests\EntryRequest;
use App\Interfaces\HighlighterPluginInterface;
use App\Models\Entry;
use App\Models\UserEntry;
use App\Settings\GeneralSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class EntryController extends Controller
{
    /**
     * @param Request $request
     * @param string $uuid
     * @return string
     */
    private function slug(Request $request, string $uuid) : string
    {
        $excepts = Entry::all()->pluck("slug");

        $slug = "";
        $slug .= Str::random(2);
        $slug .= Str::of(Uuid::fromString($uuid)->getHex()->toString())->substr(rand(0, 3), rand(0, 4));
        $slug .= rand(10, 99) . Str::random(3);

        if (in_array($slug, $excepts->toArray())) {
            return $this->slug($request, $uuid);
        }

        return $slug;
    }

    /**
     * EntryController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EntryRequest $request
     * @return RedirectResponse
     */
    public function store(EntryRequest $request) : RedirectResponse
    {
        $request->validate([
            'format' => 'required|in:'.implode(',', Highlighter::highlighters($this->pluginSystem, true)->toArray()),
            'expires' => 'required|in:'.implode(',', Expires::all()->pluck("name")->toArray()),
        ]);

        $uuid = Str::uuid();
        $expire = Expires::find($request->post('expires'));
        abort_if($expire === null, 400);

        $entry = Entry::create([
            'slug' => $this->slug($request, $uuid),
            'uuid' => $uuid,
            'delete_uuid' => Str::uuid(),
            'state' => State::Active(),
            'highlighter' => $request->post('format'),
            'password' => strlen($request->post('password')) > 0 ? Hash::make($request->post('password')) : null,
            'content' => $request->post('content'),
            'expires_at' => Carbon::make($expire->time),
        ]);

        if (Auth::check()) {
            UserEntry::create([
                "user_id" => Auth::id(),
                "entry_id" => $entry->id,
            ]);
        }

        $success = collect();
        $success->add(__('privbin.entry_created'));
        $success->add(__('privbin.entry_access_address_text', ['address' => route('web.entry.show', $entry)]));
        $success->add(__('privbin.entry_destroy_text', ['code' => $entry->delete_uuid]));
        session()->flash('success', $success);

        return response()->redirectToRoute('web.entry.show', $entry);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Entry $entry
     * @return Response
     */
    public function show(Request $request, Entry $entry) : Response
    {
        abort_if($entry->state != State::Active(), 404);

        if (strlen($entry->password) > 0) {
            $session_value = session()->get("entry.access." . $entry->uuid);

            if ($session_value != $entry->password) {

                if ($session_value == "viewed") {
                    session()->flash("alert", __("privbin.again_required_password"));
                }

                return response()->view("web.entry.access", compact("entry"));
            }
        }

        session()->put("entry.access." . $entry->uuid, "viewed");

        $highlighter = Highlighter::highlighter($entry->highlighter, $this->pluginSystem);
        $content = $entry->content;

        if ($highlighter !== null) {
            $content = $highlighter::convert($content, $request);
        }

        return response()->view("web.entry.show", compact("entry", "content"));
    }

    /**
     * @param Request $request
     * @param Entry $entry
     * @return Response
     */
    public function embed(Request $request, Entry $entry) : Response
    {
        abort_if($entry->state != State::Active(), 404);

        if (strlen($entry->password) > 0) {
            abort_if(!Hash::check($request->password, $entry->password), 403);
        }

        /** @var HighlighterPluginInterface|null $highlighter */
        $highlighter = Highlighter::highlighter($entry->highlighter, $this->pluginSystem);
        $content = $entry->content;

        if ($highlighter != null) {
            $content = $highlighter->convert($content, $request);
        }

        if (config('app.env') !== 'production') {
            app('debugbar')->disable();
        }

        $dark = $request->get('theme') == 'dark';
        return response()->view('web.entry.embed', compact('entry', 'content', 'dark'));
    }

    /**
     * @param Request $request
     * @param Entry $entry
     * @return Response
     */
    public function raw(Request $request, Entry $entry): Response
    {
        abort_if($entry->state != State::Active(), 404);

        if (strlen($entry->password) > 0) {
            abort_if(!Hash::check($request->password, $entry->password), 403);
        }

        return response($entry->content, 200)->header('Content-Type', 'text/plain');
    }

    /**
     * @param Request $request
     * @param Entry $entry
     * @return RedirectResponse|Response
     */
    public function access(Request $request, Entry $entry)
    {
        $request->validate([
            'password' => 'required',
        ]);

        if (strlen($entry->password) > 0) {
            if (Hash::check($request->password, $entry->password)) {
                session()->put('entry.access.'.$entry->uuid, $entry->password);
                return response()->redirectToRoute('web.entry.show', $entry);
            }

            return back()->withErrors([
                __('privbin.wrong_password'),
            ]);
        }

        return response()->view('web.entry.show', compact('entry'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Entry $entry
     * @return RedirectResponse
     */
    public function destroy(Request $request, Entry $entry): RedirectResponse
    {
        $request->validate([
            'token' => 'required|string|min:2',
        ]);
        abort_if($entry->delete_uuid != $request->token, 403);
        $entry->update(['state' => State::Deleted()]);
        return \response()->redirectToRoute('web.home.index');
    }
}
