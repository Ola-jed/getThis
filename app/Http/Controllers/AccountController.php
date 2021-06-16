<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * Show the profile of the asked user
     * If user not found, 404
     * @param int $userId
     * @return Application|Factory|\Illuminate\Contracts\View\View|Redirector|RedirectResponse
     */
    public function show(int $userId): \Illuminate\Contracts\View\View|Factory|Redirector|RedirectResponse|Application
    {
        if(!session()->has('user')) return redirect('/');
        try
        {
            $requestedUser = User::findOrFail($userId);
            $articlesWritten = $requestedUser
                ->articles()
                ->limit(10)
                ->get();
            $discussionsCreated = $requestedUser->discussions()
                ->withCount('messages')
                ->orderBy('messages_count', 'desc')
                ->limit(10)
                ->get();
            return \view('account.account')->with([
                'user' => $requestedUser,
                'articles' => $articlesWritten,
                'discussions' => $discussionsCreated
            ]);
        }
        catch (Exception)
        {
            abort(404);
        }
    }
}
