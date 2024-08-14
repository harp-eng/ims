<?php

namespace Modules\Order\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Order\Models\Order;
use Modules\Product\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Order\Models\OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $OrderIDs = Order::pluck('id')->toArray();
        $ProductIDs = Product::pluck('id')->toArray();

        $quantity = $this->faker->numberBetween(1, 10);
        $unitPrice = $this->faker->randomFloat(2, 5, 100); // Unit price between 5.00 and 100.00
        $totalPrice = $quantity * $unitPrice;

        return [
            'OrderID' => $this->faker->randomElement($OrderIDs), // Assuming you have at least 100 orders
            'ProductID' => $this->faker->randomElement($ProductIDs), // Assuming you have at least 100 products
            'Quantity' => $quantity,
            'UnitPrice' => $unitPrice,
            'TotalPrice' => $totalPrice,
            'Notes' => $this->faker->optional()->paragraph,
            'created_by' => $this->faker->optional()->numberBetween(1, 50), // Assuming you have at least 50 users
            'updated_by' => $this->faker->optional()->numberBetween(1, 50),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
