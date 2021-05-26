<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\MessageCreationRequest;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    public function getAll()
    {

    }

    /**
     * Store a new message in the db
     * @param int $discussionId
     * @param MessageCreationRequest $messageCreationRequest
     */
    public function store(int $discussionId, MessageCreationRequest $messageCreationRequest)
    {
        if(!Session::has('user')) return;
        Message::create([
            'content' => $messageCreationRequest->input('content'),
            'writer_id' => Session::get('user')->id,
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
        if(!Session::has('user')) return false;
        $messageToDelete = Message::find($messageId);
        if(Session::get('user')->id !== $messageToDelete->writer_id) return false;
        return Message::destroy($messageId);
    }
}
