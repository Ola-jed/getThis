<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discussion extends Model
{
    use HasFactory;
    protected $fillable = [
        'creator_id',
        'subject'
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
