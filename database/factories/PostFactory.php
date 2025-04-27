<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(2),
            'content' => $this->faker->text(50),
            'category_id' => Category::get()->random()->id,
            'likes' =>  random_int(1, 2000),
            'is_published' => true,
        ];
    }
}
