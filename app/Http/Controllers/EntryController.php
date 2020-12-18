<?php

namespace App\Http\Controllers;

use App\Enums\EntryType;
use App\Enums\State;
use App\Http\Requests\EntryRequest;
use App\Models\Entry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        return response()->redirectToRoute('web.entry.show', $entry);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param \App\Models\Entry $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Entry $entry)
    {
        if (strlen($entry->password) > 0) {
            if (session()->has('entry.access.'.$entry->uuid)) {
                if (session()->get('entry.access'.$entry->uuid) == $entry->password) {
                    return response()->view('web.entry.show', compact('entry'));
                }
            }
            return response()->view('web.entry.access', compact('entry'));
        }
        return response()->view('web.entry.show', compact('entry'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        //
    }
}
