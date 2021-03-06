<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

/**
 * Class ForgotPasswordController
 * Password reset, we send a link by email
 * @package App\Http\Controllers
 */
class ForgotPasswordController extends Controller
{
    /**
     * Show the forgot password form
     * @return Factory|View|Application
     */
    public function forgetPasswordForm(): Factory|View|Application
    {
        return view('auth.forgotpassword');
    }

    /**
     * Send the password reset email to the user
     * @param ForgetPasswordRequest $forgetPasswordRequest
     * @return RedirectResponse
     */
    public function submitForgetPasswordForm(ForgetPasswordRequest $forgetPasswordRequest): RedirectResponse
    {
        $userExisting = User::whereEmail($forgetPasswordRequest->input('email'))
            ->exists();
        if(!$userExisting)
        {
            return back()
                ->withInput()
                ->withErrors(['email' => 'This user is not registered']);
        }
        $status = Password::sendResetLink(
            $forgetPasswordRequest->input('email')
        );
        session(['email' => $forgetPasswordRequest->input('email')]);
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Show the password reset form
     * @param string $token
     * @return Factory|View|Application
     */
    public function passwordResetForm(string $token): Factory|View|Application
    {
        session(['token' => $token]);
        session()->save();
        return view('auth.passwordreset')->with(['token' => $token]);
    }

    /**
     * Reset the password
     * @param PasswordResetRequest $passwordResetRequest
     * @return RedirectResponse
     */
    public function submitPasswordResetForm(PasswordResetRequest $passwordResetRequest): RedirectResponse
    {
        if(session()->get('token') !== $passwordResetRequest->input('token'))
        {
            return back()
                ->withInput()
                ->withErrors(['token' => 'Invalid token']);
        }
        if(session()->get('email') !== $passwordResetRequest->input('email'))
        {
            return back()
                ->withInput()
                ->withErrors(['email' => 'Invalid email']);
        }
        User::whereEmail($passwordResetRequest->input('email'))
            ->update([
                'password' => Hash::make($passwordResetRequest->input('password'))
            ]);
        return redirect('/login');
    }
}
