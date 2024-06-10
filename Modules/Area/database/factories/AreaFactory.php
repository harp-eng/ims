<?php

namespace Modules\Area\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Area\Enums\AreaStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Area\Models\Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $coordinates = [
            [
                ['lat' => $this->faker->latitude, 'lng' => $this->faker->longitude],
                ['lat' => $this->faker->latitude, 'lng' => $this->faker->longitude],
                ['lat' => $this->faker->latitude, 'lng' => $this->faker->longitude],
                ['lat' => $this->faker->latitude, 'lng' => $this->faker->longitude],
                ['lat' => $this->faker->latitude, 'lng' => $this->faker->longitude],
            ]
        ];

        return [
            'name' => substr($this->faker->text(15), 0, -1),
            'description' => $this->faker->paragraph,
            'vendor_id' => 1,
            'polygon_coords'=>json_encode($coordinates),
            'status' => $this->faker->randomElement(AreaStatus::getAllNames()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
