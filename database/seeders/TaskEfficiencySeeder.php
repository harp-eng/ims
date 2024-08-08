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
        $users = User::all();

        $tasks = ['Filling', 'Labelling', 'Packing', 'Product Making'];

        foreach ($users as $user) {
            foreach ($tasks as $task) {
                TaskEfficiency::create([
                    'user_id' => $user->id,
                    'task_name' => $task,
                    'efficiency_score' => rand(1, 10), // Random efficiency score between 1 and 10
                ]);
            }
        }
    }
}
