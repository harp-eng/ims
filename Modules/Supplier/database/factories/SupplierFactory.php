<?php

namespace Modules\Supplier\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Supplier\Models\Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => substr($this->faker->text(15), 0, -1),
            'slug' => '',
            'description' => $this->faker->paragraph,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->numberBetween(0, 1),
            'ContactName' => $this->faker->name,
            'ContactEmail' => $this->faker->email,
            'ContactPhone' => $this->faker->phoneNumber,
            'Address' => $this->faker->address,
            'City' => $this->faker->city,
            'State' => $this->faker->state,
            'ZipCode' => $this->faker->postcode,
            'Country' => $this->faker->country,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
