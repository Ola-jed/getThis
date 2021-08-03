<?php

namespace Database\Seeders;

use App\Models\{Article, Comment, Discussion, Message, User};
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
        User::factory(30)->create();
        Article::factory(10)->create();
        Comment::factory(60)->create();
        Discussion::factory(10)->create();
        Message::factory(50)->create();
    }
}
