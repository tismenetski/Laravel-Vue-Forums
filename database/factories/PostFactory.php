<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'title' => $this->faker->text(30),
            'content' => $this->faker->text(180),
            'user_id' => User::all()->random()->id,
            'topic_id' => Topic::all()->random()->id,
            'upvotes' => 0,
            'downvotes' => 0
        ];
    }
}
