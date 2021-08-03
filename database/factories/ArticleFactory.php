<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = $this->faker->sentence;
        return [
            'subject' => $this->faker->catchPhrase,
            'title'   => $title,
            'slug'    => Str::slug($title),
            'content' => $this->faker->sentences(15, true),
            'user_id' => $this->faker->randomElement(User::pluck('id')->all())
        ];
    }
}
