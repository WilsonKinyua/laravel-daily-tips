<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        // $this->call(ArticleTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);

        DB::table('articles')->insert([
            'title' => Str::random(50),
            'body' => Str::random(50),
        ]);

    }
}
