<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscussionCreationRequest;
use App\Models\Discussion;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class DiscussionController extends Controller
{
    private const LIMIT_NUM = 10;
    private const OFFSET = 'offset';

    /**
     * Display a listing of the articles.
     * Offset and limit can be passed
     * @param Request $args
     * @return View|Factory|Application|RedirectResponse
     */
    public function index(Request $args): View|Factory|Application|RedirectResponse
    {
        if(!Session::has('user')) return redirect('/');
        // If a valid offset is given, we consider it. Otherwise, we start from zero
        $offset = $args->has(self::OFFSET) && intval($args->input(self::OFFSET)) > 0 ?
            intval($args->input(self::OFFSET)) : 0;
        $discussions = DB::table('discussions')
            ->limit(self::LIMIT_NUM)
            ->select(['id','subject','author_id','created_at','updated_at'])
            ->offset($offset)
            ->get();
        return view('discussion.discussions')->with(['discussions' => $discussions]);
    }

    /**
     * Create a new discussion
     *
     * @param DiscussionCreationRequest $request
     * @return Redirector|RedirectResponse|Application|View
     */
    public function store(DiscussionCreationRequest $request): Redirector|RedirectResponse|Application|View
    {
        if(!Session::has('user')) return redirect('/');
        $discussion = Discussion::create([
            'subject' => $request->input('subject'),
            'creator_id' => Session::get('user')->id
        ]);
        return view('discussion.discussion')->with(['discussion' => $discussion]);
    }

    /**
     * Display the specified discussion.
     *
     * @param int $discId
     * @return Factory|View|RedirectResponse|Application
     */
    public function show(int $discId): Factory|View|RedirectResponse|Application
    {
        if(!Session::has('user')) return redirect('/');
        try
        {
            $disc = Discussion::findOrFail($discId);
            return view('discussion.discussion')->with(['discussion' => $disc]);
        }
        catch (Exception $exception)
        {
            return back();
        }
    }

    /**
     * Update the specified discussion if the user is the author.
     *
     * @param DiscussionCreationRequest $request
     * @param int $discussionId
     * @return Response|Redirector|Application|RedirectResponse|View
     */
    public function update(DiscussionCreationRequest $request,int $discussionId): Response|Redirector|Application|RedirectResponse|View
    {
        if(!Session::has('user')) return redirect('/');
        Discussion::where('id',$discussionId)
            ->update($request->all());
        $discussion = Article::find($discussionId);
        return view('discussion.discussion')->with(['article' => $discussion]);
    }

    /**
     * Delete a discussion if the connected user is the author.
     *
     * @param int $discussionId
     * @return Factory|Response|View|RedirectResponse|Application
     */
    public function destroy(int $discussionId): Factory|Response|View|RedirectResponse|Application
    {
        if(!Session::has('user')) return redirect('/');
        // Check that connected user is author of the article
        $discussionToDelete = Discussion::find($discussionId);
        if($discussionToDelete->writer_id === Session::get('user')->id)
        {
            $discussionToDelete->delete();
            return view('discussion.discussions');
        }
        else
        {
            return back()->withErrors([
                'message' => 'You don\'t have the permission to delete this article'
            ]);
        }
    }

    /**
     * Get all the discussions by subject
     * @param Request $searchRequest
     * @return mixed
     */
    public function searchBySubject(Request $searchRequest): mixed
    {
        return Discussion::where('title','LIKE',"%{$searchRequest->input('subject')}%")
            ->get();
    }
}
