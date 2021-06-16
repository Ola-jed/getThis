<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationMail;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\Factory;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class UserSocialAuthController
 * Social auth with google and github
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
     * Github redirect
     * @return RedirectResponse
     */
    public function githubRedirectTo(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Github callback function
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
            $findUser = User::where($column, $user->id)
                ->first();
            if (!is_null($findUser))
            {
                session(['user' => $user]);
                return redirect('/');
            }
            // else
            $findUser = User::where('email', $user->getEmail())
                ->first();
            if (is_null($findUser))
            {
                $name = empty($user->getName()) ? "User" : $user->getName();
                $newUser = User::create([
                    'name' => $name,
                    'email' => $user->getEmail(),
                    $column => $user->getId(),
                    'password' => Hash::make('0000')
                ]);
                if (is_null($newUser))
                {
                    return view('error')->with([
                        'message' => 'Registration with '.$driver.' failed'
                    ]);
                }
                Mail::to($newUser->email)
                    ->send(new RegistrationMail($newUser));
                session(['user' => $newUser]);
                return redirect('/');
            }
            return view('error')->with([
                'message' => 'Email address already in use'
            ]);
        }
        catch (Exception $e)
        {
            return view('error')->with([
                'message' => 'Something weird happened : '.$e->getMessage()
            ]);
        }
    }
}