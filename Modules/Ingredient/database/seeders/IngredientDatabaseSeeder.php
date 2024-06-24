<?php

namespace Modules\Ingredient\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Ingredient\Models\Ingredient;

class IngredientDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /*
         * Ingredients Seed
         * ------------------
         */

        // DB::table('ingredients')->truncate();
        // echo "Truncate: ingredients \n";

        Ingredient::factory()->count(20)->create();
        $rows = Ingredient::all();
        echo " Insert: ingredients \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
