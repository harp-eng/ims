<?php

namespace Modules\Address\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Address\Models\Address;

class AddressDatabaseSeeder extends Seeder
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
         * Addresses Seed
         * ------------------
         */

        // DB::table('addresses')->truncate();
        // echo "Truncate: addresses \n";

        Address::factory()->count(20)->create();
        $rows = Address::all();
        echo " Insert: addresses \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
