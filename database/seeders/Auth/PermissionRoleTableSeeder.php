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

        $modulesPath = base_path('Modules');
        $moduleDirectories = File::directories($modulesPath);

        foreach ($moduleDirectories as $moduleDirectory) {
            $moduleName = basename($moduleDirectory);
            $moduleName = Str::lower(Str::plural($moduleName));

            $manager->givePermissionTo('add_'.$moduleName);
            $manager->givePermissionTo('edit_'.$moduleName);
            $manager->givePermissionTo('view_'.$moduleName);
            $manager->givePermissionTo('delete_'.$moduleName);
            $manager->givePermissionTo('restore_'.$moduleName);
        }
        $manager->givePermissionTo('view_backend');
        $manager->givePermissionTo('view_dashboard');
        $manager->givePermissionTo('view_circles');
        $manager->givePermissionTo('view_activity-log');
        $manager->givePermissionTo('admin_manager_dashboard');
        $manager->givePermissionTo('view_users');
        $manager->givePermissionTo('add_users');
        $manager->givePermissionTo('edit_users');
        // $manager->givePermissionTo('edit_users_permissions');
        $manager->givePermissionTo('delete_users');
        // $manager->givePermissionTo('restore_users');
        // $manager->givePermissionTo('block_users');

        $executive = Role::create(['id' => '4', 'name' => 'executive']);
        $executive->givePermissionTo('view_backend');

        $user = Role::create(['id' => '5', 'name' => 'user']);

        $user = Role::create(['id' => '6', 'name' => 'customer']);
        
        $user = Role::create(['id' => '7', 'name' => 'worker']);

        $user->givePermissionTo('view_backend');
        $user->givePermissionTo('view_dashboard');
        $user->givePermissionTo('employee_dashboard');
        $user->givePermissionTo('view_timesheets');
        $user->givePermissionTo('view_ordersheets');
        $user->givePermissionTo('view_circles');
        $user->givePermissionTo('view_activity-log');

        $user = Role::create(['id' => '8', 'name' => 'compounder']);
        $user->givePermissionTo('view_backend');
        $user->givePermissionTo('view_dashboard');
        $user->givePermissionTo('employee_dashboard');
        $user->givePermissionTo('view_timesheets');
        $user->givePermissionTo('view_basematerials');
        $user->givePermissionTo('add_basematerials');
        $user->givePermissionTo('edit_basematerials');
        $user->givePermissionTo('view_circles');
        $user->givePermissionTo('view_activity-log');

        $user = Role::create(['id' => '9', 'name' => 'sales']);

        $user->givePermissionTo('view_backend');
        $user->givePermissionTo('view_dashboard');
        $user->givePermissionTo('admin_manager_dashboard');
        $user->givePermissionTo('view_orders');
        $user->givePermissionTo('add_orders');
        $user->givePermissionTo('edit_orders');
        $user->givePermissionTo('view_circles');
        $user->givePermissionTo('view_activity-log');
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
        

        Artisan::call('auth:permissions', [
            'name' => 'categories',
        ]);
        

        Artisan::call('auth:permissions', [
            'name' => 'tags',
        ]);
        

        Artisan::call('auth:permissions', [
            'name' => 'comments',
        ]);
        

        $modulesPath = base_path('Modules');
        $moduleDirectories = File::directories($modulesPath);

        foreach ($moduleDirectories as $moduleDirectory) {
            $moduleName = basename($moduleDirectory);
            $moduleName = Str::lower(Str::plural($moduleName));
            
            Artisan::call('auth:permissions', [
                'name' => $moduleName,
            ]);
            
        }
        
        
    }
}
