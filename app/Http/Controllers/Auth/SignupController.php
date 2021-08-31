<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Mail\RegistrationMail;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

/**
 * Class SignupController
 * Signup new users
 * @package App\Http\Controllers
 */
class SignupController extends Controller
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
            $userCreated = User::createFromInformation($signInRequest->validated());
            session(['user' => $userCreated]);
            Mail::to($userCreated->email)
                ->send(new RegistrationMail($userCreated));
            return redirect('/');
        }
        catch (Exception)
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
}
