<?php

namespace Modules\Location\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Location\Models\Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cap = $this->faker->numberBetween(150, 300);
        return [
            'name' => array_rand(array_flip(trans('ingredient::text.inventoryLocations'))),
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->numberBetween(0, 1),
            'Zone' => $this->faker->optional()->word,
            'Aisle' => $this->faker->optional()->word,
            'Rack' => $this->faker->optional()->word,
            'Shelf' => $this->faker->optional()->word,
            'Bin' => $this->faker->optional()->word,
            'Capacity' => $cap,
            'CurrentOccupancy' => $this->faker->numberBetween(50, 150),
            'Type' => array_rand(array_flip(['Storage', 'Picking', 'Packing'])),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
