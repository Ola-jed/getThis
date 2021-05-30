<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'subject' => $this->faker->catchPhrase,
            'title' => $this->faker->sentence,
            'content' => $this->faker->sentences(15,true),
            'user_id' => $this->faker->randomElement(User::all()->pluck('id')->all())
        ];
    }
}
