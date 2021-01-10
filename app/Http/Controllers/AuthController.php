<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function login(Request $request)
    {
        $this->middleware('guest');

        if ($request->method() === 'POST') {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
                'remember' => 'nullable|sometimes',
            ]);

            $credentials = [
                'email' => $request->post('email'),
                'password' => $request->post('password'),
            ];
            $remember = $request->has('remember') && $request->post('remember') == 'remember';

            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return response()->redirectToRoute('web.home.index');
            }

            return back()->withErrors([__('privbin.invalid_credentials')]);
        }

        return response()->view('web.auth.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function register(Request $request)
    {
        $this->middleware('guest');

        if ($request->method() === 'POST') {
            $request->validate([
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|email|min:3|max:255|unique:users,email',
                'password' => 'required|string|min:6|max:255|confirmed',
            ]);

            Auth::login(User::create([
                'name' => $request->post('name'),
                'email' => $request->post('email'),
                'password' => Hash::make($request->post('password')),
            ]));

            return redirect()->route('web.home.index');
        }

        return response()->view('web.auth.register');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        $this->middleware('auth');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('web.home.index');
    }
}
