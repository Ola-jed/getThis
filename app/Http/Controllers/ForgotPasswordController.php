<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

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
        $userExisting = User::where('email',$forgetPasswordRequest->input('email'))
            ->exists();
        if(!$userExisting)
        {
            return back()->withErrors(['email' => 'Email not found']);
        }
        $status = Password::sendResetLink(
            $forgetPasswordRequest->only('email')
        );
        Session::put('email',$forgetPasswordRequest->input('email'));
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
        return view('auth.passwordreset')->with(['token' => $token]);
    }

    /**
     * Reset the password
     * @param PasswordResetRequest $passwordResetRequest
     * @return RedirectResponse
     */
    public function submitPasswordResetForm(PasswordResetRequest $passwordResetRequest): RedirectResponse
    {
        $status = Password::reset(
            $passwordResetRequest->only('email','password','password_confirmation','password','token'),
            function ($user, $password) use ($passwordResetRequest)
            {
                $user->forceFill([
                    'password' => Hash::make($passwordResetRequest->input('password1'))
                ]);
                $user->save();
                event(new PasswordReset($user));
            }
        );
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
