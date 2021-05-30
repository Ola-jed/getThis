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

class ArticleController extends Controller
{
    private const LIMIT_NUM = 10;
    private const OFFSET = 'offset';

    /**
     * Display a listing of the articles.
     * Offset and limit can be passed
     * We get the latest articles first
     * @param Request $args
     * @return View|Factory|Application|RedirectResponse
     */
    public function index(Request $args): View|Factory|Application|RedirectResponse
    {
        if(!Session::has('user')) return redirect('/');
        // If a valid offset is given, we consider it. Otherwise, we start from zero
        $offset = $args->has(self::OFFSET) && intval($args->input(self::OFFSET)) > 0 ?
            intval($args->input(self::OFFSET)) : 0;
        $articles = Article::limit(self::LIMIT_NUM)
            ->orderBy('id','desc')
            ->offset($offset)
            ->get();
        return view('article.articles')->with(['articles' => $articles]);
    }

    /**
     * Store a newly created article.
     *
     * @param ArticleCreationRequest $request
     * @return Redirector|RedirectResponse|Application
     */
    public function store(ArticleCreationRequest $request): Redirector|RedirectResponse|Application
    {
        if(!Session::has('user')) return redirect('/');
        $article = Article::create([
            'subject' => $request->input('subject'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => Session::get('user')->id
        ]);
        return redirect('article/'.$article->id);
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
            return view('article.article')->with(['article' => $article]);
        }
        catch (Exception)
        {
            return back();
        }
    }

    /**
     * Show the form to update the specified article
     * @param int $articleId
     * @return Response|Redirector|Application|RedirectResponse|View
     */
    public function edit(int $articleId): Response|Redirector|Application|RedirectResponse|View
    {
        if(!Session::has('user')) return redirect('/');
        $articleToUpdate = Article::find($articleId);
        if($articleToUpdate->user_id === Session::get('user')->id)
        {
            return \view('article.articleupdate')->with(['article' => $articleToUpdate]);
        }
        return redirect('article/'.$articleId);
    }

    /**
     * Update the specified article in database.
     *
     * @param ArticleCreationRequest $request
     * @param int $articleId
     * @return Response|Redirector|Application|RedirectResponse
     */
    public function update(ArticleCreationRequest $request, int $articleId): Response|Redirector|Application|RedirectResponse
    {
        if(!Session::has('user')) return redirect('/');
        Article::where('id',$articleId)
            ->update($request->only(['title','subject','content']));
        return redirect('article/'.$articleId);
    }

    /**
     * Remove the specified article
     * This method is built to be called by js
     * @param int $articleId
     * @return void
     */
    public function destroy(int $articleId): void
    {
        $articleToDelete = Article::find($articleId);
        if($articleToDelete->user_id === Session::get('user')->id)
        {
            $articleToDelete->delete();
        }
    }

    /**
     * Search all articles related to a subject
     * @param Request $subjectRequested
     * @return Factory|\Illuminate\Contracts\View\View|Application
     */
    public function searchBySubject(Request $subjectRequested): Factory|\Illuminate\Contracts\View\View|Application
    {
        return \view('article.articlelist')->with([
            'articles' => Article::where('subject',$subjectRequested->input('subject'))
                ->get()
        ]);
    }

    /**
     * Search all articles by title
     * @param Request $searchRequest
     * @return Factory|\Illuminate\Contracts\View\View|Application
     */
    public function searchByTitle(Request $searchRequest): \Illuminate\Contracts\View\View|Factory|Application
    {
        return \view('article.articlelist')->with([
            'articles' => Article::where('title','LIKE','%'.$searchRequest->input('title').'%')
                ->get()
        ]);
    }
}
