<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Http\Requests\MessageCreationRequest;

/**
 * Class MessageController
 * Messages posted in discussions
 * @package App\Http\Controllers
 */
class MessageController extends Controller
{
    /**
     * Get all the messages relative to a discussion
     * @param int $discussionId
     * @return Factory|View|Application
     */
    public function getAll(int $discussionId): Factory|View|Application
    {
        return \view('discussion.messages')->with([
            'messages' => Message::getLatestOfDiscussion($discussionId)
        ]);
    }

    /**
     * Store a new message in the db
     * @param int $discussionId
     * @param MessageCreationRequest $messageCreationRequest
     */
    public function store(int $discussionId, MessageCreationRequest $messageCreationRequest)
    {
        Message::create([
            'content' => $messageCreationRequest->input('content'),
            'user_id' => session()->get('user')->id,
            'discussion_id' => $discussionId
        ]);
    }

    /**
     * Delete a message with it's id
     * The connected user must be the author of the message
     * @param int $messageId
     * @return bool
     */
    public function destroy(int $messageId): bool
    {
        $messageToDelete = Message::find($messageId);
        if(session()->get('user')->id !== $messageToDelete->user_id) return false;
        return Message::destroy($messageId);
    }
}