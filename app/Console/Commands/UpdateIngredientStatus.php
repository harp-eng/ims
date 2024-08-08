<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

class UpdateIngredientStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-ingredient-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the current date
        $now = Carbon::now();

        // Update statuses based on conditions

        // Status 'No Stock'
        DB::table('ingredients')
            ->where('QuantityInStock', '<=', 0)
            ->update(['status' => 'No Stock']);

        // Status 'Low Stock'
        DB::table('ingredients')
            ->where('QuantityInStock', '>', 0)
            ->whereColumn('QuantityInStock', '<=', 'SafetyStockLevel')
            ->update(['status' => 'Low Stock']);

        // Status 'Expired'
        DB::table('ingredients')
            ->where('ExpiryDate', '<', $now)
            ->update(['status' => 'Expired']);

        // Status 'In Stock'
        DB::table('ingredients')
            ->where('QuantityInStock', '>', 0)
            ->where('QuantityInStock', '>', DB::raw('SafetyStockLevel'))
            ->where('ExpiryDate', '>=', $now)
            ->update(['status' => 'In Stock']);

        //=================for base material================

         // Status 'No Stock'
         DB::table('basematerials')
         ->where('QuantityInStock', '<=', 0)
         ->update(['status' => 'No Stock']);

     // Status 'Low Stock'
     DB::table('basematerials')
         ->where('QuantityInStock', '>', 0)
         ->where('QuantityInStock', '<=', 10)
         ->update(['status' => 'Low Stock']);

     // Status 'Expired'
     DB::table('basematerials')
         ->where('ExpiryDate', '<', $now)
         ->update(['status' => 'Expired']);

     // Status 'In Stock'
     DB::table('basematerials')
         ->where('QuantityInStock', '>', 0)
         ->where('QuantityInStock', '>', 10)
         ->where('ExpiryDate', '>=', $now)
         ->update(['status' => 'In Stock']);

        // Add more conditions as needed...

        $this->info('Ingredient statuses have been updated successfully.');
    }
}
