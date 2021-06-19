<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * Class Paste
 * Paste : a snippet of source code posted by a user and that has a slug
 * @package App\Models
 */
class Paste extends Model
{
    use HasFactory;

    /**
     * Get the user who created this paste
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create a new paste with a unique key
     * @param array $data
     * @param int $userId
     * @return Paste
     * @throws Exception
     */
    public static function createFromInfo(array $data, int $userId): Paste
    {
        $paste = Paste::create([
            'content' => $data['content'],
            'deletion_date' => Carbon::now()->addHours(intval($data['lifetime']))->toDateTime(),
            'slug' => Str::slug($data['title']),
            'user_id' => $userId
        ]);
        if(is_null($paste)) throw new Exception('Cannot create paste');
        return $paste;
    }

    /**
     * Get a paste with its slug
     * @param string $slug
     * @return Paste
     */
    public static function getWithSlug(string $slug): Paste
    {
        return Paste::where('slug',$slug)->firstOrFail();
    }

    protected $fillable = [
        'content',
        'deletion_date',
        'slug',
        'user_id'
    ];
}