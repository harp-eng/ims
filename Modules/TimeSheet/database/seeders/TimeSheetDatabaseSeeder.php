<?php

namespace Modules\TimeSheet\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\TimeSheet\Models\TimeSheet;

class TimeSheetDatabaseSeeder extends Seeder
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
         * TimeSheets Seed
         * ------------------
         */

        // DB::table('timesheets')->truncate();
        // echo "Truncate: timesheets \n";

        TimeSheet::factory()->count(20)->create();
        $rows = TimeSheet::all();
        

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
