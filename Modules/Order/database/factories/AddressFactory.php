<?php

namespace Modules\Order\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Order\Models\Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'EntityType' => $this->faker->randomElement(['Customer', 'Supplier', 'Employee', 'Partner']), // Example entity types
            'EntityID' => User::factory(), // Assuming you have at least 100 entities of each type
            'AddressLine1' => $this->faker->streetAddress,
            'AddressLine2' => $this->faker->optional()->secondaryAddress,
            'City' => $this->faker->city,
            'State' => $this->faker->state,
            'ZipCode' => $this->faker->postcode,
            'Country' => $this->faker->country,
            'AddressType' => $this->faker->randomElement(['Home', 'Work', 'Billing', 'Shipping']),
            'created_by' => $this->faker->optional()->numberBetween(1, 50), // Assuming you have at least 50 users
            'updated_by' => $this->faker->optional()->numberBetween(1, 50),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
