<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Message
 * Messages posted in discussions
 * @package App\Models
 */
class Message extends Model
{
    use HasFactory;

    /**
     * Get the latest messages of a discussion
     * @param int $discussionId
     * @return Collection
     */
    public static function getLatestOfDiscussion(int $discussionId): Collection
    {
        return Message::where('discussion_id',$discussionId)
            ->oldest('id','desc')
            ->get();
    }

    /**
     * Get the discussion related to this message
     * @return BelongsTo
     */
    public function discussion(): BelongsTo
    {
        return $this->belongsTo(Discussion::class);
    }

    /**
     * The writer of the message
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'discussion_id',
        'content'
    ];
}
