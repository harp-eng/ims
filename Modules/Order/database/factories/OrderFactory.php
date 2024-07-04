<?php

namespace Modules\Order\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Modules\Order\Models\Address;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Order\Models\Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['PENDING', 'PROCESSING', 'SHIPPED', 'DELIVERED', 'CANCELLED']),
            'CustomerID' => User::factory(), // Assuming you have at least 100 customers
            'OrderDate' => $this->faker->date,
            'ShipDate' => $this->faker->optional()->date,
            'TotalAmount' => $this->faker->randomFloat(2, 20, 1000), // Random amount between 20.00 and 1000.00
            'ShippingAddressID' => Address::factory(),
            'BillingAddressID' => Address::factory(),
            'Notes' => $this->faker->optional()->paragraph,
            'created_by' => $this->faker->optional()->numberBetween(1, 50), // Assuming you have at least 50 users
            'updated_by' => $this->faker->optional()->numberBetween(1, 50),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
