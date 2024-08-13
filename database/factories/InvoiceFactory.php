<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Modules\Order\Models\Order;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cusIds = \App\Models\User::whereHas('roles', function($query) {
            $query->whereIn('name', ['customer']);
        })->pluck('id')->toArray();

        $orderIds = Order::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($cusIds), // Assuming you have 10 users
            'order_id' => $this->faker->randomElement($orderIds), // Assuming you have 10 users
            'invoice_number' => 'INV-' . strtoupper(Str::random(5)),
            'invoice_date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
            'subtotal' => $this->faker->randomFloat(2, 50, 1000),
            'tax' => $this->faker->randomFloat(2, 5, 100),
            'total' => function (array $attributes) {
                return $attributes['subtotal'] + $attributes['tax'];
            },
            'notes' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['draft', 'sent', 'paid', 'cancelled']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
