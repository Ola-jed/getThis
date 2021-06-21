<?php

namespace App\Models;

use Database\Factories\ArticleFactory;
use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Article
 * Articles on the platform
 *
 * @package App\Models
 * @property int $id
 * @property string $subject
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read User $user
 * @method static ArticleFactory factory(...$parameters)
 * @method static Builder|Article newModelQuery()
 * @method static Builder|Article newQuery()
 * @method static Builder|Article query()
 * @method static Builder|Article whereContent($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereSlug($value)
 * @method static Builder|Article whereSubject($value)
 * @method static Builder|Article whereTitle($value)
 * @method static Builder|Article whereUpdatedAt($value)
 * @method static Builder|Article whereUserId($value)
 * @mixin Eloquent
 */
class Article extends Model
{
    use HasFactory;

    /**
     * Create an article with the data and the writer
     * @param array $information
     * @param User $writer
     * @return mixed
     * @throws Exception
     */
    public static function createFromInformation(array $information, User $writer): Article
    {
        $article = Article::create([
            'subject' => $information['subject'],
            'title' => $information['title'],
            'slug' => Str::slug($information['title']),
            'content' => $information['content'],
            'user_id' => $writer->id
        ]);
        if(is_null($article)) throw new Exception('Article creation failed');
        return $article;
    }

    /**
     * Search an article with the title
     * @param string $title
     * @return Collection
     */
    public static function searchByTitle(string $title): Collection
    {
        return Article::where('title','LIKE','%'.$title.'%')
            ->get();
    }

    /**
     * Search an article with the subject
     * @param string $subject
     * @return Collection
     */
    public static function searchBySubject(string $subject): Collection
    {
        return Article::where('subject',$subject)
            ->get();
    }

    /**
     * Get the latest articles with the number given
     * @param int $number
     * @return Collection
     */
    public static function getLatest(int $number = 5): Collection
    {
        return Article::latest()
            ->limit($number)
            ->get();
    }

    /**
     * Get an article by slug
     * @param string $slug
     * @return Article
     */
    public static function getBySlug(string $slug): Article
    {
        return Article::whereSlug($slug)
            ->firstOrFail();
    }

    /**
     * Get with limit and offset
     * @param int $limit
     * @param int $offset
     * @return Collection|\Illuminate\Support\Collection
     */
    public static function getByLimitAndOffset(int $limit, int $offset = 0): Collection|\Illuminate\Support\Collection
    {
        return Article::limit($limit)
            ->latest()
            ->offset($offset)
            ->get();
    }

    /**
     * The comments related to the article
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    /**
     * The writer of the article
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'subject',
        'title',
        'slug',
        'content',
        'user_id'
    ];
}
