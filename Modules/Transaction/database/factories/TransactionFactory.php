<?php

namespace Modules\Transaction\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Role;

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
        $user = User::factory()->create();
        $customerRole = Role::firstOrCreate(['name' => 'customer']);
        $user->roles()->attach($customerRole);

        return [
            'user_id' => $user->id,
            'payment_method' => $this->faker->randomElement(['Bank Transfer']),
            'transaction_date' => $this->faker->dateTimeThisYear(),
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'currency' => 'USD',
            'status' => $this->faker->randomElement(['Pending', 'Completed', 'Failed']),
            'reference_number' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'description' => $this->faker->sentence,
        ];
    }
}
