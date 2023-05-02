<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasteStoreRequest;
use App\Models\Paste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PasteStoreRequest $request)
    {
        $paste = Paste::query()->create($request->validated());

        return response()->json([
            'id' => $paste->uuid,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Paste $paste)
    {
        abort_if($paste->isExpired(), 404);

        if ($paste->isProtected()) {
            if (! $paste->isPasswordValid($request->bearerToken() ?? '')) {
                return response()->json([
                    'password' => true,
                ], 403);
            }
        }

        return response()->json([
            'title' => $paste->title,
            'language' => $paste->language,
            'content' => $paste->content,
        ]);
    }

    public function raw(Paste $paste)
    {
        abort_if($paste->isExpired(), 404);
        abort_if($paste->isProtected(), 403);

        return response($paste->content, 200, [
            'Content-Type' => 'text/plain',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paste $paste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paste $paste)
    {
        //
    }
}
