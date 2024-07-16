<?php

namespace Modules\Order\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Role;
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
        $order_date = $this->faker->dateTimeBetween('-1 month', 'now');
        $ship_date = (clone $order_date)->modify('+2 days');

        // Format the dates as needed
        $formatted_order_date = $order_date->format('Y-m-d');
        $formatted_ship_date = $ship_date->format('Y-m-d');

        $status = $this->faker->randomElement(['Pending','Processing','Ready To Ship','Shipped','Delivered','Cancelled']);
        if($status!='Delivered'&&$status!='Shipped'){
            $formatted_ship_date=null;
        }

        $user = User::factory()->create();
        $customerRole = Role::firstOrCreate(['name' => 'customer']);
        $user->roles()->attach($customerRole);

        return [
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['Pending','Processing','Ready To Ship','Shipped','Delivered','Cancelled']),
            'CustomerID' => $user, // Assuming you have at least 100 customers
            'OrderDate' => $formatted_order_date,
            'ShipDate' => $formatted_ship_date,
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
