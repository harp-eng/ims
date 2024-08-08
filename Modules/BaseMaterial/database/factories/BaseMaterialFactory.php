<?php

namespace Modules\BaseMaterial\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Modules\Location\Models\Location;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BaseMaterialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\BaseMaterial\Models\BaseMaterial::class;

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

        $LocationIDs = Location::pluck('id')->toArray();

        $compunderIds = \App\Models\User::whereHas('roles', function($query) {
            $query->where('name', 'compounder');
        })->pluck('id')->toArray();

        return [
            'name' => array_rand(trans('ingredient::text.products')),
            'description' => $this->faker->paragraph,
            'status' => array_rand(trans('ingredient::text.status_array')),
            'SKU' => $sku, // Unique EAN-13 barcode
            'Barcode' => $this->faker->ean13,
            'QuantityProduced' => $this->faker->randomFloat(2, 0, 1000),
            'QuantityInStock' => $this->faker->randomFloat(2, 0, 1000),
            'LeadTimeDays' => $this->faker->numberBetween(1, 30),
            'ExpiryDate' => $this->faker->dateTimeBetween('now', '+5 years')->format('Y-m-d'),
            'IsPerishable' => $this->faker->randomElement(['yes', 'no']),
            'IsHazardous' => $this->faker->randomElement(['yes', 'no']),
            'UnitOfMeasure' => 'KG',
            'IsQualityCheck' => $this->faker->randomElement(['yes']),
            'UserID' => $this->faker->randomElement($compunderIds),
            'LocationID' => $this->faker->randomElement($LocationIDs),
            'Notes' => $this->faker->optional()->text,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
