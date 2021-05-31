<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountUpdateRequest;
use App\Mail\AccountDeletedMail;
use App\Models\Article;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;


class ProfileController extends Controller
{
    /**
     * Get the profile page of the connected user
     * @return View|Factory|Application|RedirectResponse
     */
    public function index(): View|Factory|Application|RedirectResponse
    {
        if(!Session::has('user')) return redirect('/');
        $articlesWritten = Session::get('user')->articles;
        $discussionsCreated = Discussion::where('user_id',Session::get('user')->id)
            ->limit(10)
            ->get();
        $articleCount = Article::where('user_id',Session::get('user')->id)
            ->count();
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
        if(!Session::has('user')) return redirect('/');
        $userToUpdate = User::find(Session::get('user')->id);
        // Let's update the user attributes
        $userToUpdate->name = $updateAccount->input('name');
        $userToUpdate->email = $updateAccount->input('email');
        $userToUpdate->password = empty($updateAccount->input('new_password')) ?
            $userToUpdate->password : Hash::make($updateAccount->input('new_password'));
        $userToUpdate->save();
        Session::put('user',$userToUpdate);
        return redirect('/profile');
    }

    /**
     * Delete the account of the connected user
     * @return Redirector|RedirectResponse|Application
     */
    public function destroy(): Redirector|RedirectResponse|Application
    {
        if(!Session::has('user')) return redirect('/');
        if(User::destroy(Session::get('user')->id))
        {
            Mail::to(Session::get('user')->email)
                ->send(new AccountDeletedMail(Session::get('user')));
            Session::flush();
            return redirect('/register');
        }
        return redirect('/profile');
    }
}
