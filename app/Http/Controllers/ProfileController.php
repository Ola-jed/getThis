<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountUpdateRequest;
use App\Mail\AccountDeletedMail;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Illuminate\Routing\Redirector;

/**
 * Class ProfileController
 * User profile
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * Get the profile page of the connected user
     * @return View|Factory|Application|RedirectResponse
     */
    public function index(): View|Factory|Application|RedirectResponse
    {
        if(!session()->has('user')) return redirect('/');
        $articlesWritten = session()->get('user')->articles;
        $articleCount = count($articlesWritten);
        $discussionsCreated = session()->get('user')
            ->discussions()
            ->withCount('messages')
            ->orderBy('messages_count', 'desc')
            ->limit(10)
            ->get();
        return \view('profile.profile')->with([
            'articles' => $articlesWritten,
            'discussions' => $discussionsCreated,
            'article_count' => $articleCount
        ]);
    }

    /**
     * Update the account of the connected user
     * @param AccountUpdateRequest $updateAccount
     * @return Redirector|RedirectResponse|Application
     */
    public function update(AccountUpdateRequest $updateAccount): Redirector|RedirectResponse|Application
    {
        if(!session()->has('user')) return redirect('/');
        $userToUpdate = User::find(session()->get('user')->id);
        // Let's update the user attributes
        $userToUpdate->name = $updateAccount->input('name');
        $userToUpdate->email = $updateAccount->input('email');
        $userToUpdate->password = empty($updateAccount->input('new_password'))
            ? $userToUpdate->password
            : Hash::make($updateAccount->input('new_password'));
        $userToUpdate->save();
        session(['user' => $userToUpdate]);
        return redirect('/profile');
    }

    /**
     * Delete the account of the connected user
     * @return Redirector|RedirectResponse|Application
     */
    public function destroy(): Redirector|RedirectResponse|Application
    {
        if(!session()->has('user')) return redirect('/');
        if(User::destroy(session()->get('user')->id))
        {
            Mail::to(session()->get('user')->email)
                ->send(new AccountDeletedMail(session()->get('user')));
            session()->flush();
            return redirect('/register');
        }
        return redirect('/profile');
    }
}
