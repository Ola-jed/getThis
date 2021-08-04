<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationMail;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class UserSocialAuthController
 * Social auth with Google and GitHub
 * @package App\Http\Controllers
 */
class UserSocialAuthController extends Controller
{
    /**
     * Send redirect to google
     * @return RedirectResponse
     */
    public function googleRedirectTo(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * GitHub redirect
     * @return RedirectResponse
     */
    public function githubRedirectTo(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * GitHub callback function
     * @return Application|\Illuminate\Http\RedirectResponse|Redirector|View
     */
    public function githubCallback(): Application|\Illuminate\Http\RedirectResponse|Redirector|View
    {
        return $this->callback('github', 'github_id');
    }

    /**
     * Google callback function
     * @return Application|\Illuminate\Http\RedirectResponse|Redirector|View
     */
    public function googleCallback(): Application|\Illuminate\Http\RedirectResponse|Redirector|View
    {
        return $this->callback('google', 'google_id');
    }

    /**
     * @param string $driver
     * @param string $column
     * @return Factory|Redirector|Application|\Illuminate\Http\RedirectResponse|View
     */
    private function callback(string $driver, string $column): Factory|Redirector|Application|\Illuminate\Http\RedirectResponse|View
    {
        try
        {
            $user = Socialite::driver($driver)->user();
            $userWithSocialId = User::where($column, $user->id)
                ->first();
            if($userWithSocialId !== null)
            {
                session(['user' => $userWithSocialId]);
                return redirect('/');
            }
            $userWithSameEmail = User::where('email', $user->getEmail())
                ->first();
            if($userWithSameEmail === null)
            {
                $name = empty($user->getName()) ? "User" : $user->getName();
                $newUser = User::create([
                    'name'     => $name,
                    'email'    => $user->getEmail(),
                    $column    => $user->getId(),
                    'password' => Hash::make(Str::random())
                ]);
                if($newUser === null)
                {
                    return view('error')->with([
                        'message' => 'Registration with ' . $driver . ' failed'
                    ]);
                }
                session(['user' => $newUser]);
                Mail::to($newUser->email)
                    ->send(new RegistrationMail($newUser));
                return redirect('/');
            }
            return view('error')->with([
                'message' => 'Email address already in use'
            ]);
        }
        catch(Exception)
        {
            return view('error')->with([
                'message' => 'Something weird happened'
            ]);
        }
    }
}