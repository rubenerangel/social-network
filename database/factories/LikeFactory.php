<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function() {
                return User::factory()->create();
            },
            // 'status_id' => function() {
            //     return Status::factory()->create();
            // },
        ];
    }
}
