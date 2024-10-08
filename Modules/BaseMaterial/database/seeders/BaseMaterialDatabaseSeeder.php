<?php

namespace Modules\BaseMaterial\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\BaseMaterial\Models\BaseMaterial;
use Modules\Ingredient\Models\BaseMaterialIngredient;

class BaseMaterialDatabaseSeeder extends Seeder
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
         * BaseMaterials Seed
         * ------------------
         */

        // DB::table('basematerials')->truncate();
        // echo "Truncate: basematerials \n";

        BaseMaterial::factory()->count(10)->create();
        $rows = BaseMaterial::all();
        
        BaseMaterialIngredient::factory()->count(10)->create();
        $rows = BaseMaterialIngredient::all();

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
