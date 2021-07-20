<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCreationRequest;
use App\Models\Article;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ArticleController
 * Controller for articles management
 * @package App\Http\Controllers
 */
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
        // If a valid offset is given, we consider it. Otherwise, we start from zero
        $offset = $args->has(self::OFFSET) && intval($args->input(self::OFFSET)) > 0
            ? intval($args->input(self::OFFSET))
            : 0;
        $articles = Article::getByLimitAndOffset(self::LIMIT_NUM,$offset);
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
        try
        {
            $article = Article::createFromInformation($request->all(),session()->get('user'));
            return redirect('article/'.$article->slug);
        }
        catch (Exception)
        {
            return back()->withInput()
                ->withErrors([
                    'message' => 'Cannot create the article'
                ]);
        }
    }

    /**
     * Display the specified article.
     *
     * @param string $slug
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(string $slug): Factory|View|RedirectResponse|Application
    {
        try
        {
            $article = Article::getBySlug($slug);
            return view('article.article')->with(['article' => $article]);
        }
        catch (Exception)
        {
            abort(404);
        }
    }

    /**
     * Show the form to update the specified article
     * @param string $slug
     * @return Response|Redirector|Application|RedirectResponse|View
     */
    public function edit(string $slug): Response|Redirector|Application|RedirectResponse|View
    {
        try
        {
            $articleToUpdate = Article::getBySlug($slug);
            if($articleToUpdate->user_id === session()->get('user')->id)
            {
                return \view('article.articleupdate')->with(['article' => $articleToUpdate]);
            }
            return redirect('article/'.$slug);
        }
        catch (Exception)
        {
           return redirect('/articles');
        }
    }

    /**
     * Update the specified article in database.
     * @param ArticleCreationRequest $request
     * @param string $slug
     * @return Response|Redirector|Application|RedirectResponse
     */
    public function update(ArticleCreationRequest $request, string $slug): Response|Redirector|Application|RedirectResponse
    {
        $articleToUpdate = Article::getBySlug($slug);
        if(session()->get('user')->id === $articleToUpdate->user_id)
        {
            $articleToUpdate->title = $request->input('title');
            $articleToUpdate->slug = Str::slug($request->input('title'));
            $articleToUpdate->subject = $request->input('subject');
            $articleToUpdate->content = $request->input('content');
            $articleToUpdate->save();
            // When the update is finished, we redirect with the new slug
            return redirect('article/'.Str::slug($request->input('title')));
        }
        return redirect('/articles');
    }

    /**
     * Remove the specified article
     * This method is built to be called by js
     * @param string $slug
     * @return void
     */
    public function destroy(string $slug): void
    {
        $articleToDelete = Article::getBySlug($slug);
        if($articleToDelete->user_id === session()->get('user')->id)
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
            'articles' => Article::searchBySubject($subjectRequested->input('subject'))
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
            'articles' => Article::searchByTitle($searchRequest->input('title'))
        ]);
    }
}