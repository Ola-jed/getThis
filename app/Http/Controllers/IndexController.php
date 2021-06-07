<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Discussion;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

/**
 * Class IndexController
 * Index page
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    /**
     * Method to check if index should appear
     * @return Application|Factory|View|RedirectResponse
     */
    public function index(): Application|Factory|View|RedirectResponse
    {
        if(Session::has('user'))
        {
            return view('index')->with([
                'latest' => $this->getLatestArticles(),
                'hottest' => $this->getHottestDiscussions()
            ]);
        }
        return redirect('/login');
    }

    /**
     * Get the 5 latest articles
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLatestArticles(): \Illuminate\Database\Eloquent\Collection
    {
        return Article::Orderby('created_at','DESC')
            ->limit(5)
            ->get();
    }

    /**
     * Get the discussions with the most messages
     * @return Collection
     */
    public function getHottestDiscussions(): Collection
    {
        return Discussion::withCount('messages')
            ->orderBy('messages_count', 'desc')
            ->get(10);
    }
}