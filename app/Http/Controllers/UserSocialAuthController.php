<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
     * @return Application|\Illuminate\Http\RedirectResponse|Redirector
     */
    public function githubCallback(): Application|\Illuminate\Http\RedirectResponse|Redirector
    {
        return $this->callback('github', 'github_id');
    }

    /**
     * Google callback function
     * @return \Illuminate\Http\RedirectResponse|Application|Redirector
     */
    public function googleCallback(): Application|\Illuminate\Http\RedirectResponse|Redirector
    {
        return $this->callback('google', 'google_id');
    }

    /**
     * @param string $driver
     * @param string $column
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|Redirector|Application|\Illuminate\Http\RedirectResponse
     */
    private function callback(string $driver, string $column): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|Redirector|Application|\Illuminate\Http\RedirectResponse
    {
        try
        {
            $user = Socialite::driver($driver)->user();
            $findUser = User::where($column, $user->id)
                ->first();
            if ($findUser)
            {
                Session::put('user',$user);
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
                Session::put('user',$user);
                return redirect('/');
            }
            return view('error')->with([
                'message' => 'Email address already in use'
            ]);
        }
        catch (Exception $e)
        {
            return view('error')->with([
                'message' => $e->getMessage()
            ]);
        }
    }
}
