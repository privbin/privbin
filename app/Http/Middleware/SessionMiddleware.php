<?php

namespace App\Http\Middleware;

use App\Models\Session;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class SessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $session = Session::where('ip_address', $request->ip())->where('user_agent', $request->userAgent())->first();
        if ($session == null) {
            $session = Session::create([
                'uuid' => Str::uuid(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'last_activity' => Carbon::now(),
            ]);
        }
        session()->put('session_uuid', $session->uuid);
        return $next($request);
    }
}
