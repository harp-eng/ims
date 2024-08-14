<?php

namespace Modules\Order\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

use Modules\Order\Models\Order;
use Modules\BaseMaterial\Models\BaseMaterial;
use Modules\Supplier\Models\Supplier;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BaseMaterialOrdersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Order\Models\BaseMaterialOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $BaseMaterialIDs = BaseMaterial::pluck('id')->toArray();
        $OrderIDs = Order::pluck('id')->toArray();

        $workerIds = \App\Models\User::whereHas('roles', function($query) {
            $query->where('name', 'worker');
        })->pluck('id')->toArray();

        return [
            'BaseMaterialID' => $this->faker->randomElement($BaseMaterialIDs),
            'OrderID' => $this->faker->randomElement($OrderIDs),
            'QuantityUsed' => $this->faker->randomFloat(2, 1, 100), // Adjust range as necessary
            'LeftQuantity' => $this->faker->randomFloat(2, 1, 100), // Adjust range as necessary
            'created_by' => $this->faker->randomElement($workerIds), // Assuming user IDs 1-10
            'updated_by' => $this->faker->randomElement($workerIds),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
