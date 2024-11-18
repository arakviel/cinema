<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Liamtseva\Cinema\Models\Tag;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->words(2);
        $description = $this->faker->sentence(10);

        return [
            'slug' => $name, // затестити
            'name' => $name,
            'description' => $description,
            'image' => $this->faker->boolean(50) ? $this->faker->imageUrl(640, 480, 'tags') : null,
            'aliases' => json_encode($this->faker->words(rand(0, 10))),
            'is_genre' => $this->faker->boolean(20),
            'meta_title' => $this->faker->boolean(70) ? $this->faker->words(3, true).'| '.config('app.name') : "$name | ".config('app.name'),
            'meta_description' => $this->faker->boolean(70) ? $this->faker->sentence(15) : $description,
            'meta_image' => $this->faker->boolean(50) ? $this->faker->imageUrl(640, 480, 'tags-meta') : null,
        ];
    }
}
