<?php

namespace Modules\Ingredient\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Modules\Ingredient\Models\Ingredient;
use Modules\Supplier\Models\Supplier;
use Modules\Location\Models\Location;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class IngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Ingredient\Models\Ingredient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Generate a random number for SKU
        $randomNumber = $this->faker->unique()->randomNumber(5);

        $IngredientIDs = Ingredient::pluck('id')->toArray();
        $SupplierIDs = Supplier::pluck('id')->toArray();
        $LocationIDs = Location::pluck('id')->toArray();

        $managerIds = \App\Models\User::whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        })
            ->pluck('id')
            ->toArray();

        // Create a unique SKU by concatenating a prefix with the random number
        $sku = 'SKU-' . $randomNumber;
        return [
            'name' => array_rand(trans('ingredient::text.ingredients_name')),
            'slug' => '',
            'description' => $this->faker->paragraph,
            'SKU' => $sku,
            'status' => array_rand(trans('ingredient::text.status_array')),
            'SupplierID' => $this->faker->randomElement($SupplierIDs), // Get a random Supplier ID
            'LocationID' => $this->faker->randomElement($LocationIDs), // Get a random Supplier ID
            'QuantityInStock' => rand(100, 1000),
            'PurchaseDate' => $this->faker->date(),
            'ExpiryDate' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'QuantityPurchased' => $this->faker->numberBetween(1, 1000), // Adjust range as necessary
            'QuantityUsed' => 0, // Adjust range as necessary
            'UnitPrice' => $this->faker->randomFloat(2, 0.5, 100), // Min price 0.5, max price 100
            'TotalPrice' => function (array $attributes) {
                return $attributes['QuantityPurchased'] * $attributes['UnitPrice'];
            },
            'DeliveryDate' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'IsPerishable' => $this->faker->randomElement(['yes', 'no']),
            'IsHazardous' => $this->faker->randomElement(['yes', 'no']),
            'UnitOfMeasure' => array_rand(trans('ingredient::text.units')),
            'created_at' => Carbon::now(),
            'updated_at' => $this->faker->dateTimeBetween('-10 days', 'now'),
        ];
    }
}
