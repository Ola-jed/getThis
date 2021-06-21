<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * Class Paste
 * Paste : a snippet of source code posted by a user and that has a slug
 *
 * @package App\Models
 * @property int $id
 * @property string $content
 * @property string $deletion_date
 * @property string $slug
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|Paste newModelQuery()
 * @method static Builder|Paste newQuery()
 * @method static Builder|Paste query()
 * @method static Builder|Paste whereContent($value)
 * @method static Builder|Paste whereCreatedAt($value)
 * @method static Builder|Paste whereDeletionDate($value)
 * @method static Builder|Paste whereId($value)
 * @method static Builder|Paste whereSlug($value)
 * @method static Builder|Paste whereUpdatedAt($value)
 * @method static Builder|Paste whereUserId($value)
 * @mixin Eloquent
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