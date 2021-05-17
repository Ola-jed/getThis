<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCreationRequest;
use App\Models\Article;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    private const LIMIT_NUM = 10;
    private const OFFSET = 'offset';

    /**
     * Display a listing of the articles.
     * Offset and limit can be passed
     * @param Request $args
     * @return Application|Factory|View
     */
    public function index(Request $args): View|Factory|Application
    {
        if(!Session::has('user')) return redirect('/');
        // If a valid offset is given, we consider it. Otherwise, we start from zero
        $offset = $args->has(self::OFFSET) && intval($args->input(self::OFFSET)) > 0 ?
            intval($args->input(self::OFFSET)) : 0;
        $articles = DB::table('articles')
            ->limit(self::LIMIT_NUM)
            ->select(['id,subject,title,writer_id,created_at,updated_at'])
            ->offset($offset)
            ->get();
        return view('articles')->with(['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function create(): Response|Redirector|Application|RedirectResponse
    {
        //
        if(!Session::has('user')) return redirect('/');

    }

    /**
     * Store a newly created article.
     *
     * @param ArticleCreationRequest $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(ArticleCreationRequest $request): Redirector|RedirectResponse|Application
    {
        if(!Session::has('user')) return redirect('/');
        $article = Article::create([
            'subject' => $request->input('subject'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'writer_id' => Session::get('user')->id
        ]);
        return view('read')->with(['article' => $article]);
    }

    /**
     * Display the specified article.
     *
     * @param int $articleId
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(int $articleId): Factory|View|RedirectResponse|Application
    {
        if(!Session::has('user')) return redirect('/');
        try
        {
            $article = Article::findOrFail($articleId);
            return view('article')->with(['article' => $article]);
        }
        catch (Exception $exception)
        {
            return back()->withErrors([
                'message' => 'Article not found'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Redirector|RedirectResponse
     */
    public function edit(int $id): Redirector|RedirectResponse|Application
    {
        if(!Session::has('user')) return redirect('/');

    }

    /**
     * Update the specified article in database.
     *
     * @param ArticleCreationRequest $request
     * @param int $articleId
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(ArticleCreationRequest $request, int $articleId): Response|Redirector|Application|RedirectResponse
    {
        if(!Session::has('user')) return redirect('/');
        Article::where('id',$articleId)
            ->update($request->all());
        $article = Article::find($articleId);
        return view('article')->with(['article' => $article]);
    }

    /**
     * Remove the specified article
     *
     * @param int $articleId
     * @return Application|Factory|View|RedirectResponse|Response
     */
    public function destroy(int $articleId): Factory|Response|View|RedirectResponse|Application
    {
        if(!Session::has('user')) return redirect('/');
        // Check that connected user is author of the article
        $articleToDelete = Article::find($articleId);
        if($articleToDelete->writer_id === Session::get('user')->id)
        {
            $articleToDelete->delete();
            return view('articles');
        }
        else
        {
            return back()->withErrors([
                'message' => 'You don\'t have the permission to delete this article'
            ]);
        }
    }
}
