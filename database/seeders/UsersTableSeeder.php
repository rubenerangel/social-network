<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Status::truncate();

        User::factory()->create([
            'name'  =>  'Rubén',
            'email' => 'rubenrang@gmail.com'
        ]);

        Status::factory()->times(10)->create();
    }
}
