<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5),
            'content' => $this->faker->realTextBetween(1000, 2000),
            'category_id' => Category::get()->random()->id,
            'preview_image' => 'images/' . random_int(1, 24) . '.jpg',
            'main_image' => 'images/' . random_int(1, 24) . '.jpg',
        ];
    }
}
