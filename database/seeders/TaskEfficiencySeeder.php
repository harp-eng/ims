<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskEfficiency;
use App\Models\User;

class TaskEfficiencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assuming you have some users already created
        $empIds = \App\Models\User::whereHas('roles', function($query) {
            $query->whereIn('name', ['worker']);
        })->pluck('id')->toArray();

        $tasks = ['Filling', 'Labelling', 'Packing'];

        foreach ($empIds as $user) {
            foreach ($tasks as $task) {
                TaskEfficiency::create([
                    'user_id' => $user,
                    'task_name' => $task,
                    'efficiency_score' => rand(1, 10), // Random efficiency score between 1 and 10
                ]);
            }
        }

        // Assuming you have some users already created
        $empIds = \App\Models\User::whereHas('roles', function($query) {
            $query->whereIn('name', ['compounder']);
        })->pluck('id')->toArray();

        $tasks = ['Product Making'];

        foreach ($empIds as $user) {
            foreach ($tasks as $task) {
                TaskEfficiency::create([
                    'user_id' => $user,
                    'task_name' => $task,
                    'efficiency_score' => rand(1, 10), // Random efficiency score between 1 and 10
                ]);
            }
        }
    }
}
