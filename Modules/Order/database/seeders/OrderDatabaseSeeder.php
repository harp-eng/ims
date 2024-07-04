<?php

namespace Modules\Order\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderDetail;
use Modules\Order\Models\Address;

class OrderDatabaseSeeder extends Seeder
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
         * Orders Seed
         * ------------------
         */

        // DB::table('orders')->truncate();
        // echo "Truncate: orders \n";

        Order::factory()->count(20)->create();
        $rows = Order::all();
        echo " Insert: orders \n\n";

        OrderDetail::factory()->count(20)->create();
        $rows = Order::all();
        echo " Insert: orders \n\n";

        Address::factory()->count(20)->create();
        $rows = Order::all();
        echo " Insert: orders \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
