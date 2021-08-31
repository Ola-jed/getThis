<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

/**
 * Class LogoutController
 * Users logout
 * @package App\Http\Controllers
 */
class LogoutController extends Controller
{
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
