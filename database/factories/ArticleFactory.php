<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence, // Generate a random sentence
            'content' => $this->faker->paragraphs(3, true), // Generate 3 paragraphs
            'status' => $this->faker->randomElement(['draft', 'pending', 'published']), // Random status
            'user_id' => User::inRandomOrder()->first()->id, // Associate with a random user
            'category_id' => Category::inRandomOrder()->first()->id ?? null, // Associate with a random category
        ];
    }
}
