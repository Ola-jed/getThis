<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Mail\RegistrationMail;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

/**
 * Class UserAuthController
 * Auth for users
 * @package App\Http\Controllers
 */
class UserAuthController extends Controller
{
    /**
     * Get the signup/register view
     * @return Factory|View|Application
     */
    public function signupView(): Factory|View|Application
    {
        return view('auth.register');
    }

    /**
     * Create a new user
     * @param SignUpRequest $signInRequest
     * @return Redirector|Application|RedirectResponse|View
     */
    public function signUp(SignUpRequest $signInRequest): Redirector|Application|RedirectResponse|View
    {
        try
        {
            $userCreated = User::createFromInformation($signInRequest->all());
            session(['user' => $userCreated]);
            Mail::to($userCreated->email)
                ->send(new RegistrationMail($userCreated));
            return redirect('/');
        }
        catch(Exception)
        {
            User::whereEmail($signInRequest->input('email'))
                ->delete();
            return back()
                ->withInput()
                ->withErrors([
                    'message' => 'Cannot create the user'
                ]);
        }
    }

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
        if(Auth::attempt($signInRequest->only('email', 'password'),$signInRequest->has('remember-me')))
        {
            $user = Auth::user();
            session(['user' => $user]);
            return redirect('/');
        }
        else
        {
            return back()
                ->withInput()
                ->withErrors([
                    'message' => 'Invalid password or email'
                ]);
        }
    }

    /**
     * Logout the connected user
     * @return Redirector|Application|RedirectResponse
     */
    public function logout(): Redirector|Application|RedirectResponse
    {
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
}
