<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Ramsey\Collection\Collection;

/**
 * Class Article
 * Articles on the platform
 * @package App\Models
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
     * @return Collection
     */
    public static function getByLimitAndOffset(int $limit, int $offset = 0): Collection
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
