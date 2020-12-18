<?php

namespace App\Http\Controllers;

use App\Enums\EntryType;
use App\Enums\State;
use App\Http\Requests\EntryRequest;
use App\Models\Entry;
use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EntryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param EntryRequest $request
     * @return RedirectResponse
     */
    public function store(EntryRequest $request): RedirectResponse
    {
        $expires = $request->post('expires');
        $expires = explode('_', $expires);
        $expires = Carbon::make("+{$expires[1]} {$expires[0]}");

        $entry = Entry::create([
            'uuid' => Str::uuid(),
            'delete_uuid' => Str::uuid(),
            'state' => State::Active(),
            'type' => $request->post('format'),
            'password' => strlen($request->post('password')) > 0 ? Hash::make($request->post('password')) : null,
            'content' => $request->post('content'),
            'expires_at' => $expires,
        ]);

        session()->flash('alert', __('privbin.entry_created', ['show' => route('web.entry.show', $entry), 'destroy' => $entry->delete_uuid]));
        return response()->redirectToRoute('web.entry.show', $entry);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Entry $entry
     * @return Response
     */
    public function show(Request $request, Entry $entry): Response
    {
        abort_if($entry->state != State::Active(), 404);

        if ($entry->expires_at->lessThanOrEqualTo(Carbon::now())) {
            $entry->update(['state' => State::Deleted()]);
        }

        if (strlen($entry->password) > 0) {
            if (session()->get('entry.access.'.$entry->uuid) == $entry->password) {
                goto SHOW;
            }
            else if (session()->get('entry.access.'.$entry->uuid) == 'viewed') {
                session()->flash('alert', __('privbin.again_required_password'));
            }
            return response()->view('web.entry.access', compact('entry'));
        }

        SHOW:
        session()->put('entry.access.'.$entry->uuid, 'viewed');
        return response()->view('web.entry.show', compact('entry'));
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
