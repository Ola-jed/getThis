<?php

namespace Database\Factories;

use App\Models\Discussion;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'user_id'       => $this->faker->randomElement(User::pluck('id')->all()),
            'discussion_id' => $this->faker->randomElement(Discussion::pluck('id')->all()),
            'content'       => $this->faker->realText()
        ];
    }
}
