<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkerPerformance;
use App\Models\User;

class WorkerPerformancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assume that you already have workers in your 'workers' table
        $workerIds = \App\Models\User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['worker','compounder']);
        })->pluck('id')->toArray();
        

        foreach ($workerIds as $worker) {
            WorkerPerformance::create([
                'worker_id' => $worker,
                'task_name' => 'Filling',
                'task_time_taken' => rand(40, 60),  // Random time between 40 and 60
                'quality_of_work' => rand(6, 10),  // Random quality between 6 and 10
                'quantity' => rand(50, 100),       // Random quantity between 50 and 100
            ]);

            WorkerPerformance::create([
                'worker_id' => $worker,
                'task_name' => 'Labelling',
                'task_time_taken' => rand(30, 50),
                'quality_of_work' => rand(7, 10),
                'quantity' => rand(60, 120),
            ]);

            WorkerPerformance::create([
                'worker_id' => $worker,
                'task_name' => 'Packing',
                'task_time_taken' => rand(45, 70),
                'quality_of_work' => rand(5, 9),
                'quantity' => rand(40, 90),
            ]);

            WorkerPerformance::create([
                'worker_id' => $worker,
                'task_name' => 'ProductMaking',
                'task_time_taken' => rand(50, 80),
                'quality_of_work' => rand(8, 10),
                'quantity' => rand(70, 150),
            ]);
        }
    }
}
