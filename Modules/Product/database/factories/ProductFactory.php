<?php

namespace Modules\Product\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Product\Models\Product::class;

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
         $sku = 'SKU-' . $randomNumber;
        return [
            'name'              => array_rand(trans('ingredient::text.products')),
            'slug'              => '',
            'description'       => $this->faker->paragraph,
            'status' => $this->faker->numberBetween(0, 1),
            'CategoryID' => null, // Replace with actual logic if needed
            'SKU' => $sku, // Generates a random SKU
            'Unit' => array_rand(array_flip(['Bottles', 'Pots'])), // Generates a random SKU
            'Barcode' => $this->faker->ean13, // Generates a random Barcode
            'QuantityInStock' => $this->faker->numberBetween(0, 1000),
            'UnitPrice' => $this->faker->randomFloat(2, 1, 1000),
            'CostPrice' => $this->faker->optional()->randomFloat(2, 0.5, 800), // Optional field
            'ReorderLevel' => $this->faker->numberBetween(10, 50),
            'ReorderQuantity' => $this->faker->numberBetween(50, 200),
            'StorageLocation' => $this->faker->optional()->word,
            'LeadTimeDays' => $this->faker->numberBetween(1, 30),
            'ExpiryDate' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'MinOrderQuantity' => $this->faker->numberBetween(1, 10),
            'MaxOrderQuantity' => $this->faker->numberBetween(100, 1000),
            'SafetyStockLevel' => $this->faker->numberBetween(80, 1000),
            'IsPerishable' => $this->faker->randomElement(['yes', 'no']),
            'IsHazardous' => $this->faker->randomElement(['yes', 'no']),
            'Notes' => $this->faker->optional()->paragraph,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];
    }
}
