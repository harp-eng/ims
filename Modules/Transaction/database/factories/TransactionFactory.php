<?php

namespace Modules\Transaction\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Transaction\Models\Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->paragraph,
            'status' => $this->faker->boolean ? 1 : 0,
            'EntityType' => $this->faker->randomElement(['Customer', 'Supplier', 'Employee', 'Other']),
            'EntityID' => $this->faker->numberBetween(1, 1000), // Assuming EntityID is within this range
            'TransactionDate' => $this->faker->dateTime,
            'UserID' => $this->faker->numberBetween(1, 100), // Assuming UserID is within this range
            'Notes' => $this->faker->text,
        ];
    }
}
