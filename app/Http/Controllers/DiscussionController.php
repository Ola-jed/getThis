<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Exception;
use App\Http\Requests\DiscussionCreationRequest;
use App\Models\Discussion;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Illuminate\Routing\Redirector;

/**
 * Class DiscussionController
 * Discussions
 * @package App\Http\Controllers
 */
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
        // If a valid offset is given, we consider it. Otherwise, we start from zero
        $offset = $args->has(self::OFFSET) && intval($args->input(self::OFFSET)) > 0 ?
                intval($args->input(self::OFFSET)) : 0;
        $discussions = Discussion::withCount('messages')
            ->latest()
            ->limit(self::LIMIT_NUM)
            ->offset($offset)
            ->get();
        return view('discussion.discussions')->with(['discussions' => $discussions]);
    }

    /**
     * Create a new discussion
     * And redirect to the right view
     * @param DiscussionCreationRequest $request
     * @return Redirector|RedirectResponse|Application
     */
    public function store(DiscussionCreationRequest $request): Redirector|RedirectResponse|Application
    {
        $discussion = Discussion::create([
            'subject' => $request->input('subject'),
            'user_id' => session()->get('user')->id
        ]);
        if(is_null($discussion)) return back();
        return redirect('discussion/'.$discussion->id);
    }

    /**
     * Display the specified discussion.
     *
     * @param int $discId
     * @return Factory|View|RedirectResponse|Application
     */
    public function show(int $discId): Factory|View|RedirectResponse|Application
    {
        try
        {
            $disc = Discussion::findOrFail($discId);
            $messages = Message::where('discussion_id',$discId)
                ->latest()
                ->get();
            return view('discussion.discussion')->with([
                'discussion' => $disc,
                'messages' => $messages
            ]);
        }
        catch (Exception)
        {
            return back();
        }
    }

    /**
     * Update the specified discussion if the user is the author.
     *
     * @param DiscussionCreationRequest $request
     * @param int $discussionId
     * @return Response|Redirector|Application|RedirectResponse
     */
    public function update(DiscussionCreationRequest $request,int $discussionId): Response|Redirector|Application|RedirectResponse
    {
        Discussion::where('id',$discussionId)
            ->update($request->only(['subject']));
        return redirect('discussion/'.$discussionId);
    }

    /**
     * Delete a discussion if the connected user is the author.
     *
     * @param int $discussionId
     * @return Factory|Response|View|RedirectResponse
     */
    public function destroy(int $discussionId): Response|Factory|View|RedirectResponse
    {
        // Check that connected user is author of the discussion
        $discussionToDelete = Discussion::find($discussionId);
        if($discussionToDelete->writer_id === session()->get('user')->id)
        {
            $discussionToDelete->delete();
            return redirect('discussions');
        }
        else
        {
            return back()->withErrors([
                'message' => 'You don\'t have the permission to delete this discussion'
            ]);
        }
    }

    /**
     * Get all the discussions by subject
     * @param Request $searchRequest
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function searchBySubject(Request $searchRequest): Application|\Illuminate\Contracts\View\Factory|View
    {
        return \view('discussion.discussionlist')->with([
            'discussions' => Discussion::getBySubject($searchRequest->input('subject'))
        ]);
    }
}
