<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudioFactory extends Factory
{
    public function definition(): array
    {
        $company = $this->faker->company();
        $slug = Str::slug($company);

        // Ensure unique slug by checking if it already exists
        $slug = $this->ensureUniqueSlug($slug);

        return [
            'slug' => $slug,
            'name' => $company,
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(),
            'meta_title' => $this->faker->sentence(),
            'meta_description' => $this->faker->sentence(),
            'meta_image' => $this->faker->imageUrl(),
        ];
    }

    /**
     * Ensure the slug is unique by appending a number if necessary.
     */
    protected function ensureUniqueSlug(string $name): string
    {
        return Str::slug($name).'-'.Str::random(6);
    }
}
