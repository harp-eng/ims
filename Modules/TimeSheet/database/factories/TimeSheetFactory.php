<?php

namespace Modules\TimeSheet\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TimeSheetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\TimeSheet\Models\TimeSheet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         // Fetch a random employee
         $user = User::factory()->create();
         $customerRole = Role::firstOrCreate(['name' => 'employee']);
         $user->roles()->attach($customerRole);

         // Randomly select sign-in and sign-out times within a single day
         $signInTime = Carbon::today()->addMinutes(rand(520, 540)); // Random sign-in time within the first 12 hours
         $signOutTime = (clone $signInTime)->addHours(8)->addMinutes(rand(0, 10)); // Random sign-out time, 1 to 8 hours after sign-in
        
         return [
             'employee_id' => $user->id,
             'sign_in_time' => $signInTime,
             'sign_out_time' => $signOutTime,
             'date' => $signInTime->toDateString(),
             'duration' => $signOutTime->diff($signInTime)->format('%H:%I:%S'),
             'notes' => $this->faker->sentence,
             'created_by' => User::inRandomOrder()->first()->id,
             'updated_by' => User::inRandomOrder()->first()->id,
             'deleted_by' => null,
         ];
        
    }
}
