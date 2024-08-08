<?php

namespace Modules\RawMaterialPurchase\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ingredient\Models\Ingredient;
use Modules\Supplier\Models\Supplier;
use Modules\Location\Models\Location;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RawMaterialPurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\RawMaterialPurchase\Models\RawMaterialPurchase::class;

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

        $managerIds = \App\Models\User::whereHas('roles', function($query) {
            $query->where('name', 'manager');
        })->pluck('id')->toArray();
        // Create a unique SKU by concatenating a prefix with the random number
        $sku = 'SKU-' . $randomNumber;
        return [
            'status' => $this->faker->randomElement([0, 1, 2]), // Assuming 0, 1, 2 for statuses like Unpublished, Published, Draft
            'IngredientID' => $this->faker->randomElement($IngredientIDs), // Get a random Ingredient ID
            'SupplierID' => $this->faker->randomElement($SupplierIDs), // Get a random Supplier ID
            'LocationID' => $this->faker->randomElement($LocationIDs), // Get a random Supplier ID
            'SKU'=>$sku,
            'PurchaseDate' => $this->faker->date(),
            'ExpiryDate'        => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'QuantityPurchased' => $this->faker->numberBetween(1, 1000), // Adjust range as necessary
            'QuantityUsed' => 0, // Adjust range as necessary
            'UnitPrice' => $this->faker->randomFloat(2, 0.5, 100), // Min price 0.5, max price 100
            'TotalPrice' => function (array $attributes) {
                return $attributes['QuantityPurchased'] * $attributes['UnitPrice'];
            },
            'DeliveryDate' => $this->faker->dateTimeBetween('-1 year','now')->format('Y-m-d'),
            'Notes' => $this->faker->optional()->text(),
            'created_by' => $this->faker->randomElement($managerIds), // Assuming users IDs 1-10
            'updated_by' => $this->faker->randomElement($managerIds), // Assuming users IDs 1-10
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
