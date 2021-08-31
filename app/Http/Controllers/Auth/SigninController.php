<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class SigninController
 * Signin
 * @package App\Http\Controllers
 */
class SigninController extends Controller
{
    /**
     * Get the signin/login view
     * @return Factory|View|Application
     */
    public function signinView(): Factory|View|Application
    {
        return view('auth.login');
    }

    /**
     * Sign in
     * If remember me is checked, we use it
     * @param SignInRequest $signInRequest
     * @return Redirector|Application|RedirectResponse|View
     */
    public function signIn(SignInRequest $signInRequest): Redirector|Application|RedirectResponse|View
    {
        if (Auth::attempt($signInRequest->only('email', 'password'), $signInRequest->has('remember-me')))
        {
            $user = Auth::user();
            session(['user' => $user]);
            return redirect('/');
        }
        return back()
            ->withInput()
            ->withErrors([
                'message' => 'Invalid credentials'
            ]);
    }
}
