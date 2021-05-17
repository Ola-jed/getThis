<?php

namespace Database\Factories;

use App\Models\Discussion;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'writer_id' => $this->faker->randomElement(User::all()->pluck('id')->all()),
            'discussion_id' => $this->faker->randomElement(Discussion::all()->pluck('id')->all()),
            'content' => $this->faker->realText()
        ];
    }
}
