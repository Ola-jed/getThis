<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserAuthController extends Controller
{
    /**
     * Get the signup/register view
     * @return Factory|View|Application
     */
    public function signupView(): Factory|View|Application
    {
        return view('register');
    }

    /**
     * Create a new user
     * @param SignUpRequest $signInRequest
     * @return Redirector|Application|RedirectResponse
     */
    public function signUp(SignUpRequest $signInRequest): Redirector|Application|RedirectResponse
    {
        $userCreated = User::create([
            'name' => $signInRequest->input('name'),
            'email' => $signInRequest->input('email'),
            'password' => Hash::make($signInRequest->input('password'))
        ]);
        if($userCreated)
        {
            Session::put('user',$userCreated);
            return redirect('index');
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
        return view('login');
    }

    /**
     * Sign in
     * @param SignInRequest $signInRequest
     * @return Redirector|Application|RedirectResponse
     */
    public function signIn(SignInRequest $signInRequest): Redirector|Application|RedirectResponse
    {
        if(Auth::attempt(['email' => $signInRequest->input('email'),'password' => $signInRequest->input('password')]))
        {
            $user = Auth::user();
            Session::put('user',$user);
            return redirect('index');
        }
        else
        {
            return back()->withErrors([
                'message' => 'Cannot login'
            ]);
        }
    }
}
