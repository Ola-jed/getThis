<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreationRequest;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class CommentController
 * Controller for comments posted under articles
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    /**
     * Get all comments related to an article
     * @param string $articleSlug
     * @return Redirector|Application|RedirectResponse|View
     */
    public function getAll(string $articleSlug): Redirector|Application|RedirectResponse|View
    {
        if(!session()->has('user')) return redirect('/');
        $commentsRelated = Article::getBySlug($articleSlug)->comments;
        return view('article.comments')->with(['comments' => $commentsRelated]);
    }

    /**
     * Post a comment
     * @param CommentCreationRequest $request
     * @param string $articleSlug
     * @return void
     */
    public function store(CommentCreationRequest $request, string $articleSlug): void
    {
        if(!session()->has('user')) return;
        Comment::create([
            'user_id' => session()->get('user')->id,
            'article_id' => Article::whereSlug($articleSlug)->first()->id,
            'content' => $request->input('content')
        ]);
    }

    /**
     * Delete a comment
     * @param int $commentId
     * @return bool
     */
    public function deleteComment(int $commentId): bool
    {
        if(!session()->has('user')) return false;
        $commentToDelete = Comment::find($commentId);
        if($commentToDelete->user_id === session()->get('user')->id)
        {
            return boolval(Comment::destroy($commentId));
        }
        return false;
    }

    /**
     * Update a comment
     * @param int $commentId
     * @param CommentCreationRequest $request
     */
    public function update(int $commentId, CommentCreationRequest $request)
    {
        if(!session()->has('user')) return;
        $commentToUpdate = Comment::find($commentId);
        if($commentToUpdate->user_id === session()->get('user')->id)
        {
            $commentToUpdate->content = $request->input('content');
            $commentToUpdate->save();
        }
    }
}
