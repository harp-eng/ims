<?php

namespace Modules\OrderSheet\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\OrderSheet\Models\OrderSheet;

class OrderSheetDatabaseSeeder extends Seeder
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
         * OrderSheets Seed
         * ------------------
         */

        // DB::table('ordersheets')->truncate();
        // echo "Truncate: ordersheets \n";

        OrderSheet::factory()->count(20)->create();
        $rows = OrderSheet::all();
        

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
