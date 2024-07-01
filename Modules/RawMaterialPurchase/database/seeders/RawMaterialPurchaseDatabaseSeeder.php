<?php

namespace Modules\RawMaterialPurchase\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\RawMaterialPurchase\Models\RawMaterialPurchase;

class RawMaterialPurchaseDatabaseSeeder extends Seeder
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
         * RawMaterialPurchases Seed
         * ------------------
         */

        // DB::table('rawmaterialpurchases')->truncate();
        // echo "Truncate: rawmaterialpurchases \n";

        RawMaterialPurchase::factory()->count(20)->create();
        $rows = RawMaterialPurchase::all();
        echo " Insert: rawmaterialpurchases \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
