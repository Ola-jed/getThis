<?php

namespace App\Models;

use Database\Factories\CommentFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Comment
 * Comment posted under articles
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property int $article_id
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Article $article
 * @property-read User $user
 * @method static CommentFactory factory( ...$parameters )
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment query()
 * @method static Builder|Comment whereArticleId( $value )
 * @method static Builder|Comment whereContent( $value )
 * @method static Builder|Comment whereCreatedAt( $value )
 * @method static Builder|Comment whereId( $value )
 * @method static Builder|Comment whereUpdatedAt( $value )
 * @method static Builder|Comment whereUserId( $value )
 * @mixin Eloquent
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
        'content'
    ];

    /**
     * The article related to the comment
     * @return BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * The writer of the comment
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
