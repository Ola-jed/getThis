<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
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
        $articlesWritten = Article::where('writer_id',Session::get('user')->id)
            ->limit(10)
            ->get();
        $discussionsCreated = Discussion::where('creator_id',Session::get('user')->id)
            ->limit(10)
            ->get();
        return \view('profile.profile')->with([
            'articles' => $articlesWritten,
            'discussions' => $discussionsCreated
        ]);
    }
}
