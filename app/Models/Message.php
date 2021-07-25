<?php

namespace App\Models;

use Database\Factories\MessageFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Message
 * Messages posted in discussions
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property int $discussion_id
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Discussion $discussion
 * @property-read User $user
 * @method static MessageFactory factory( ...$parameters )
 * @method static Builder|Message newModelQuery()
 * @method static Builder|Message newQuery()
 * @method static Builder|Message query()
 * @method static Builder|Message whereContent( $value )
 * @method static Builder|Message whereCreatedAt( $value )
 * @method static Builder|Message whereDiscussionId( $value )
 * @method static Builder|Message whereId( $value )
 * @method static Builder|Message whereUpdatedAt( $value )
 * @method static Builder|Message whereUserId( $value )
 * @mixin Eloquent
 */
class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'discussion_id',
        'content'
    ];

    /**
     * Get the latest messages of a discussion
     * @param int $discussionId
     * @return Collection
     */
    public static function getLatestOfDiscussion(int $discussionId): Collection
    {
        return Message::where('discussion_id', $discussionId)
            ->latest()
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
}
