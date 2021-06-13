<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Discussion
 * Discussions with a subject
 * @package App\Models
 */
class Discussion extends Model
{
    use HasFactory;

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

    protected $fillable = [
        'user_id',
        'subject'
    ];
}
