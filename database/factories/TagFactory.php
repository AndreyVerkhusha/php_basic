<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Tag::class;
    public $test = [
        'id' => 1,
        'title' => 'text',
        'content' => 'content',
        'category_id' => 1,
    ];
    public function definition() {
        return [
            'title' => "tag: " . $this->faker->word(),
        ];
    }
}
