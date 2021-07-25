<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id'    => $this->faker->randomElement(User::all()->pluck('id')->all()),
            'article_id' => $this->faker->randomElement(Article::all()->pluck('id')->all()),
            'content'    => $this->faker->realText()
        ];
    }
}
