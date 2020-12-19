<?php

namespace App\Http\Controllers;

use App\Enums\State;
use App\Http\Requests\EntryRequest;
use App\Models\Entry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EntryRequest $request
     * @return JsonResponse
     */
    public function store(EntryRequest $request): JsonResponse
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

        return response()->json([
            'success' => true,
            'status' => 200,
            'response' => [
                'uuid' => $entry->uuid,
                'token' => $entry->delete_uuid,
                'state' => $entry->state,
                'type' => $entry->type,
                'expires_at' => $expires,
                'content' => $entry->content,
            ],
        ], 200, JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Entry $entry
     * @return JsonResponse
     */
    public function show(Request $request, Entry $entry): JsonResponse
    {
        if ($entry->expires_at->lessThanOrEqualTo(Carbon::now())) {
            $entry->update(['state' => State::Deleted()]);
        }

        abort_if($entry->state != State::Active(), 404);

        if (strlen($entry->password) > 0) {
            if (!Hash::check($request->password, $entry->password)) {
                return response()->json([
                    'success' => false,
                    'status' => 403,
                    'data' => ['message' => 'Invalid password'],
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'status' => 200,
            'response' => [
                'uuid' => $entry->uuid,
                'state' => $entry->state,
                'type' => $entry->type,
                'expires_at' => $entry->expires_at,
                'content' => $entry->content,
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Entry $entry
     * @return JsonResponse
     */
    public function destroy(Request $request, Entry $entry): JsonResponse
    {
        $request->validate([
            'token' => 'required|string|min:2',
        ]);
        if ($entry->delete_uuid != $request->token) {
            return response()->json([
                'success' => false,
                'status' => 403,
                'data' => ['message' => 'Invalid token'],
            ]);
        }
        $entry->update(['state' => State::Deleted()]);
        return response()->json([
            'success' => true,
            'status' => 200,
            'data' => [],
        ]);
    }
}
