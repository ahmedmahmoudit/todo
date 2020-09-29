<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();
        User::factory()->create([
            'id'    => 5,
            'email' => 'asd@asd.com',
            'password' => bcrypt( 'asdasd' )
        ]);

        Category::factory(10)->create();
        Task::factory(500)->create([
            'user_id' => 5,
            'category_id' => 1
        ]);
    }
}