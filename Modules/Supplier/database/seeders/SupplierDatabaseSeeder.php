<?php

namespace Modules\Supplier\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Supplier\Models\Supplier;
use App\Models\User;

class SupplierDatabaseSeeder extends Seeder
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
         * Suppliers Seed
         * ------------------
         */

        // DB::table('suppliers')->truncate();
        // echo "Truncate: suppliers \n";

        Supplier::factory()->count(20)->create();
        $rows = Supplier::all();
        

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
