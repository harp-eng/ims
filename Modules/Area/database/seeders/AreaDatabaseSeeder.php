<?php

namespace Modules\Area\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Area\Models\Area;

class AreaDatabaseSeeder extends Seeder
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
         * Areas Seed
         * ------------------
         */

        // DB::table('areas')->truncate();
        // echo "Truncate: areas \n";

        Area::factory()->count(20)->create();
        $rows = Area::all();
        echo " Insert: areas \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
