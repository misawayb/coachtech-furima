<?php

namespace Database\Factories;

use App\Enums\Condition;
use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->name(),
            'price' => fake()->numberBetween(100,10000),
            'description' => fake()->text(100),
            'image' => 'items/sample.jpg',
            'condition' => Condition::GoodCondition,
        ];
    }
}
