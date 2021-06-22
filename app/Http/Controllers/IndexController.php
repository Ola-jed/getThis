<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Discussion;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use function session;

/**
 * Class IndexController
 * Index page
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    /**
     * Load index data and call the view
     * @return Application|Factory|View|RedirectResponse
     */
    public function index(): Application|Factory|View|RedirectResponse
    {
        return view('index')->with([
            'articles' => Article::getLatest(5),
            'discussions' => Discussion::getHottest(10)
        ]);
    }
}