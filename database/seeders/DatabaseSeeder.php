<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create Roles
        $this->call(RoleSeeder::class);

        // Create Fake Users
        User::factory(10)->create(); // Generate 10 fake users

        // Create Fake Categories
        Category::factory(5)->create(); // Generate 5 fake categories

        // Create Fake Articles
        Article::factory(50)->create(); // Generate 50 fake articles

    }
}
