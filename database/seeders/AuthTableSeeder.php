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
        
        $this->call(PermissionRoleTableSeeder::class);
        
        $this->call(UserRoleTableSeeder::class);
        
        $this->call(IngredientDatabaseSeeder::class);
        
        $this->call(BaseMaterialDatabaseSeeder::class);
        
        $this->call(LocationDatabaseSeeder::class);
        
        $this->call(ProductDatabaseSeeder::class);
        
        $this->call(SupplierDatabaseSeeder::class);
        
        $this->call(RawMaterialPurchaseDatabaseSeeder::class);
        $this->call(OrderDatabaseSeeder::class);
        $this->call(TimeSheetDatabaseSeeder::class);
        
        
        
    }
}
