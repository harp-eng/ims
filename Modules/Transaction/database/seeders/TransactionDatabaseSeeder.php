<?php

namespace Modules\Transaction\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Transaction\Models\Transaction;

class TransactionDatabaseSeeder extends Seeder
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
         * Transactions Seed
         * ------------------
         */

        // DB::table('transactions')->truncate();
        // echo "Truncate: transactions \n";

        Transaction::factory()->count(20)->create();
        $rows = Transaction::all();
        echo " Insert: transactions \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
