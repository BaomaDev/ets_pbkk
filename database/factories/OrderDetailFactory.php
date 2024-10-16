<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    protected $model = OrderDetail::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'state' => $this->faker->randomElement(['done', 'delivering', 'preparing']),
            'address' => $this->faker->address,
            'menu_id' => Menu::factory(),
            'quantity' => $this->faker->numberBetween(1, 5),
            'total_price' => $this->faker->randomFloat(2, 50, 500),
        ];
    }
}