<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 * User of the platform
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Creates  new user from the request data
     * @param array $information
     * @return User
     * @throws Exception
     */
    public static function createFromInformation(array $information): User
    {
        $user = User::create([
            'name' => $information['name'],
            'email' => $information['email'],
            'password' => Hash::make($information['password1'])
        ]);
        if(is_null($user)) throw new Exception('Cannot create user');
        return $user;
    }

    /**
     * Get all the articles written by the user
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Get all the comments written by the user
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get all the discussions created by the user
     * @return HasMany
     */
    public function discussions(): HasMany
    {
        return $this->hasMany(Discussion::class);
    }

    /**
     * Get all the messages written by the user
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'github_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}