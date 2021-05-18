<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Mail\RegistrationMail;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

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
        $userCreated = User::create([
            'name' => $signInRequest->input('name'),
            'email' => $signInRequest->input('email'),
            'password' => Hash::make($signInRequest->input('password1'))
        ]);
        if($userCreated != null)
        {
            Session::put('user',$userCreated);
            Mail::to($userCreated->email)
                ->send(new RegistrationMail($userCreated));
            return redirect('/');

        }
        else
        {
            return back()->withErrors([
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
     * @param SignInRequest $signInRequest
     * @return Redirector|Application|RedirectResponse|View
     */
    public function signIn(SignInRequest $signInRequest): Redirector|Application|RedirectResponse|View
    {
        if(Auth::attempt($signInRequest->only('email','password')))
        {
            $user = Auth::user();
            Session::put('user',$user);
            return redirect('/');
        }
        else
        {
            return back()->withErrors([
                'message' => 'Invalid password or email'
            ]);
        }
    }
}
