<?php

namespace Modules\Ingredient\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

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

        // Create a unique SKU by concatenating a prefix with the random number
        $sku = 'SKU-' . $randomNumber;
        return [
            'name' => $this->faker->unique()->name,
            'slug' => '',
            'description' => $this->faker->paragraph,
            'SKU'=>$sku,
            'status' => 1,
            'QuantityInStock' => 0,
            'ExpiryDate' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'IsPerishable' => $this->faker->randomElement(['yes', 'no']),
            'IsHazardous' => $this->faker->randomElement(['yes', 'no']),
            'UnitOfMeasure' => array_rand(trans('ingredient::text.units')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
