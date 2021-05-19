<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreationRequest;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * Get all comments related to an article
     * @param int $articleId
     * @return Redirector|Application|RedirectResponse|View
     */
    public function getAll(int $articleId): Redirector|Application|RedirectResponse|View
    {
        if(!Session::has('user')) return redirect('/');
        $commentsRelated = Comment::where('article_id',$articleId)
            ->get();
        return view('article.comments')->with(['comments' => $commentsRelated]);
    }

    /**
     * Post a comment
     * @param CommentCreationRequest $request
     * @param int $articleId
     * @return void
     */
    public function store(CommentCreationRequest $request, int $articleId): void
    {
        if(!Session::has('user')) return;
        Comment::create([
            'writer_id' => Session::get('user')->id,
            'article_id' => $articleId,
            'content' => $request->input('content')
        ]);
    }

    /**
     * Delete a comment
     * @param int $commentId
     * @return bool|int
     */
    public function deleteComment(int $commentId): bool|int
    {
        if(!Session::has('user')) return false;
        $commentToDelete = Comment::find($commentId);
        if($commentToDelete->writer_id === Session::get('user')->id)
        {
            return Comment::destroy($commentId);
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
        if(!Session::has('user')) return;
        $commentToUpdate = Comment::find($commentId);
        if($commentToUpdate->writer_id === Session::get('user')->id)
        {
            $commentToUpdate->content = $request->input('content');
            $commentToUpdate->save();
        }
    }
}
