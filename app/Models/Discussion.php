<?php

namespace App\Models;

use Database\Factories\DiscussionFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

/**
 * Class Discussion
 * Discussions with a subject
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property string $subject
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Message[] $messages
 * @property-read int|null $messages_count
 * @property-read User $user
 * @method static DiscussionFactory factory( ...$parameters )
 * @method static Builder|Discussion newModelQuery()
 * @method static Builder|Discussion newQuery()
 * @method static Builder|Discussion query()
 * @method static Builder|Discussion whereCreatedAt( $value )
 * @method static Builder|Discussion whereId( $value )
 * @method static Builder|Discussion whereSubject( $value )
 * @method static Builder|Discussion whereUpdatedAt( $value )
 * @method static Builder|Discussion whereUserId( $value )
 * @mixin Eloquent
 */
class Discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject'
    ];

    /**
     * Get the n hottest discussions
     * @param int $number
     * @return Collection
     */
    public static function getHottest(int $number): Collection
    {
        return Discussion::withCount('messages')
            ->orderBy('messages_count', 'desc')
            ->get($number);
    }

    /**
     * Get all articles by subject
     * @param string $subject
     * @return Collection
     */
    public static function getBySubject(string $subject): Collection
    {
        return Discussion::where('subject', 'LIKE', '%' . $subject . '%')
            ->get();
    }

    /**
     * Get the messages of the discussion
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * The creator of the discussion
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
