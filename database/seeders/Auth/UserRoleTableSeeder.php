<?php

namespace Database\Seeders\Auth;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        User::findOrFail(1)->assignRole('super admin');
        User::findOrFail(2)->assignRole('administrator');
        User::findOrFail(3)->assignRole('manager');
        User::findOrFail(4)->assignRole('executive');
        User::findOrFail(5)->assignRole('user');
        User::findOrFail(6)->assignRole('customer');
        User::findOrFail(7)->assignRole('customer');
        User::findOrFail(8)->assignRole('customer');
        User::findOrFail(9)->assignRole('customer');
        User::findOrFail(10)->assignRole('customer');
        User::findOrFail(11)->assignRole('worker');
        User::findOrFail(12)->assignRole('worker');
        User::findOrFail(13)->assignRole('worker');
        User::findOrFail(14)->assignRole('worker');
        User::findOrFail(15)->assignRole('worker');
        User::findOrFail(16)->assignRole('compounder');
        User::findOrFail(17)->assignRole('compounder');
        User::findOrFail(18)->assignRole('compounder');
        User::findOrFail(19)->assignRole('compounder');
        User::findOrFail(20)->assignRole('compounder');
        User::findOrFail(21)->assignRole('manager');
        User::findOrFail(22)->assignRole('manager');
        User::findOrFail(23)->assignRole('manager');
        User::findOrFail(24)->assignRole('manager');
        User::findOrFail(25)->assignRole('sales');
        User::findOrFail(26)->assignRole('sales');
        User::findOrFail(27)->assignRole('sales');
        User::findOrFail(28)->assignRole('sales');
        User::findOrFail(29)->assignRole('sales');

        Artisan::call('cache:clear');
    }
}
