<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Status;
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
    public function definition()
    {
        return [
            'body'      => $this->faker->paragraph,
            'user_id'   => function() {
                return User::factory()->create();
            },
            'status_id'   => function() {
                return Status::factory()->create();
            },
        ];
    }
}
