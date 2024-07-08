<?php

namespace Database\Seeders\Auth;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->CreateDefaultPermissions();

        /**
         * Create Roles and Assign Permissions to Roles.
         */
        $super_admin = Role::create(['id' => '1', 'name' => 'super admin']);

        $admin = Role::create(['id' => '2', 'name' => 'administrator']);
        $admin->givePermissionTo(['view_backend', 'edit_settings']);

        $manager = Role::create(['id' => '3', 'name' => 'manager']);
        $manager->givePermissionTo('view_backend');

        $executive = Role::create(['id' => '4', 'name' => 'executive']);
        $executive->givePermissionTo('view_backend');

        $user = Role::create(['id' => '5', 'name' => 'user']);
        $user = Role::create(['id' => '6', 'name' => 'customer']);
        // $user->givePermissionTo('view_backend');
        $user = Role::create(['id' => '7', 'name' => 'supplier']);
        // $user->givePermissionTo('view_backend');
        $user = Role::create(['id' => '8', 'name' => 'employee']);

        $user->givePermissionTo('view_backend');
        $user->givePermissionTo('view_dashboard');
        $user->givePermissionTo('employee_dashboard');
        $user->givePermissionTo('view_timesheets');
        $user->givePermissionTo('view_ordersheets');
        $user->givePermissionTo('view_circles');
        $user->givePermissionTo('view_activity-log');

        $user = Role::create(['id' => '9', 'name' => 'compounder']);

        $user->givePermissionTo('view_basematerials');
        $user->givePermissionTo('add_basematerials');
        $user->givePermissionTo('edit_basematerials');
    }

    public function CreateDefaultPermissions()
    {
        // Create Permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $permission) {
            $permission = Permission::make(['name' => $permission]);
            $permission->saveOrFail();
        }

        Artisan::call('auth:permissions', [
            'name' => 'posts',
        ]);
        echo "\n _Posts_ Permissions Created.";

        Artisan::call('auth:permissions', [
            'name' => 'categories',
        ]);
        echo "\n _Categories_ Permissions Created.";

        Artisan::call('auth:permissions', [
            'name' => 'tags',
        ]);
        echo "\n _Tags_ Permissions Created.";

        Artisan::call('auth:permissions', [
            'name' => 'comments',
        ]);
        echo "\n _Comments_ Permissions Created.";

        $modulesPath = base_path('Modules');
        $moduleDirectories = File::directories($modulesPath);

        foreach ($moduleDirectories as $moduleDirectory) {
            $moduleName = basename($moduleDirectory);
            $moduleName = Str::lower(Str::plural($moduleName));
            
            Artisan::call('auth:permissions', [
                'name' => $moduleName,
            ]);
            echo "\n _".$moduleName."_ Permissions Created.";
        }
        
        echo "\n\n";
    }
}
