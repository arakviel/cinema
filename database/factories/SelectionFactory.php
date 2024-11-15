<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Liamtseva\Cinema\Models\Selection;

/**
 * @extends Factory<Selection>
 */
class SelectionFactory extends Factory
{
    protected $model = Selection::class;

    public function definition(): array
    {
        return [
            'id' => (string) Str::ulid(),
            'slug' => $this->faker->unique()->slug,
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(10),
            'meta_title' => $this->faker->words(4, true),
            'meta_description' => $this->faker->text(150),
            'meta_image' => $this->faker->imageUrl(640, 480, 'business'),
        ];
    }
}
