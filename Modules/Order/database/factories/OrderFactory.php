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
        // Generate a random number for SKU
        $randomNumber = $this->faker->unique()->randomNumber(5);

        // Create a unique SKU by concatenating a prefix with the random number
        $sku = 'ORDER-' . $randomNumber;

        $order_date = $this->faker->dateTimeBetween('-1 month', 'now');
        $ship_date = (clone $order_date)->modify('+2 days');

        // Format the dates as needed
        $formatted_order_date = $order_date->format('Y-m-d');
        $formatted_ship_date = $ship_date->format('Y-m-d');

        $status = $this->faker->randomElement(['Pending','Processing','Ready To Ship','Shipped','Delivered','Cancelled']);
        if($status!='Delivered'&&$status!='Shipped'){
            $formatted_ship_date=null;
        }

        $customerIds = \App\Models\User::whereHas('roles', function($query) {
            $query->where('name', 'customer');
        })->pluck('id')->toArray();

        $AddressIDs = Address::pluck('id')->toArray();

        return [
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['Pending','Processing','Ready To Ship','Shipped','Delivered','Cancelled']),
            'payment_status' => $this->faker->randomElement(['Pending','Paid']),
            'CustomerID' => $this->faker->randomElement($customerIds), // Assuming you have at least 100 customers
            'Order_number'=>$sku,
            'OrderDate' => $formatted_order_date,
            'ShipDate' => $formatted_ship_date,
            'TotalAmount' => $this->faker->randomFloat(2, 20, 1000), // Random amount between 20.00 and 1000.00
            'ShippingAddressID' => $this->faker->randomElement($AddressIDs),
            'BillingAddressID' => $this->faker->randomElement($AddressIDs),
            'Notes' => $this->faker->optional()->paragraph,
            'created_by' => $this->faker->optional()->numberBetween(1, 50), // Assuming you have at least 50 users
            'updated_by' => $this->faker->optional()->numberBetween(1, 50),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
