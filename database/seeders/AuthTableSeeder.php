<?php

namespace Database\Seeders;

use Database\Seeders\Auth\PermissionRoleTableSeeder;
use Database\Seeders\Auth\UserRoleTableSeeder;
use Database\Seeders\Auth\UserTableSeeder;
use Modules\Ingredient\database\seeders\IngredientDatabaseSeeder;
use Modules\BaseMaterial\database\seeders\BaseMaterialDatabaseSeeder;
use Modules\Location\database\seeders\LocationDatabaseSeeder;
use Modules\Product\database\seeders\ProductDatabaseSeeder;
use Modules\Supplier\database\seeders\SupplierDatabaseSeeder;
use Modules\RawMaterialPurchase\database\seeders\RawMaterialPurchaseDatabaseSeeder;
use Modules\Order\database\seeders\OrderDatabaseSeeder;
use Modules\TimeSheet\database\seeders\TimeSheetDatabaseSeeder;



use Illuminate\Database\Seeder;

/**
 * Class AuthTableSeeder.
 */
class AuthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        echo "\n Default Users Created. \n";
        $this->call(PermissionRoleTableSeeder::class);
        echo "\n Default Permissions Created. \n";
        $this->call(UserRoleTableSeeder::class);
        echo "\n Default Roles created and assigned to Users. \n";
        $this->call(IngredientDatabaseSeeder::class);
        echo "\n seeders Ingredient Database Seeder. \n";
        $this->call(BaseMaterialDatabaseSeeder::class);
        echo "\n seeders Base Material Database Seeder. \n";
        $this->call(LocationDatabaseSeeder::class);
        echo "\n seeders Location Database Seeder. \n";
        $this->call(ProductDatabaseSeeder::class);
        echo "\n seeders Product Database Seeder. \n";
        $this->call(SupplierDatabaseSeeder::class);
        echo "\n seeders Product Database Seeder. \n";
        $this->call(RawMaterialPurchaseDatabaseSeeder::class);
        $this->call(OrderDatabaseSeeder::class);
        $this->call(TimeSheetDatabaseSeeder::class);
        echo "\n seeders Product Database Seeder. \n";
        
        
    }
}
