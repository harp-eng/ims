<?php

namespace Database\Seeders\Auth;

use App\Events\Backend\UserCreated;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $users = [
            [
                'id' => 1,
                'username' => '100001',
                'name' => 'Super Admin',
                'email' => 'super@admin.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'username' => '100002',
                'name' => 'Admin Istrator',
                'email' => 'admin@admin.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'username' => '100003',
                'name' => 'Manager User 1',
                'email' => 'manager-1@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'username' => '100004',
                'name' => 'Executive User',
                'email' => 'executive@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'username' => '100005',
                'name' => 'General User',
                'email' => 'user@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach ($users as $user_data) {
            $user = User::create($user_data);

            event(new UserCreated($user));
        }
        $i=1;
        foreach (range(6,10) as $key) {
            $user_data=[
                'id' => $key,
                'username' => '10000'.$key,
                'name' => 'customer-'.$i,
                'email' => 'customer-'.$i.'@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $user = User::create($user_data);
            event(new UserCreated($user));
            $i++;
        }
        $i=1;
        foreach (range(11,15) as $key) {
            $user_data=[
                'id' => $key,
                'username' => '10000'.$key,
                'name' => 'Worker-'.$i,
                'email' => 'worker-'.$i.'@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $user = User::create($user_data);
            event(new UserCreated($user));
            $i++;
        }
        $i=1;
        foreach (range(16,20) as $key) {
            $user_data=[
                'id' => $key,
                'username' => '10000'.$key,
                'name' => 'compounder-'.$i,
                'email' => 'compounder-'.$i.'@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $user = User::create($user_data);
            event(new UserCreated($user));
            $i++;
        }
        $i=2;
        foreach (range(21,24) as $key) {
            $user_data=[
                'id' => $key,
                'username' => '10000'.$key,
                'name' => 'manager-'.$i,
                'email' => 'manager-'.$i.'@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $user = User::create($user_data);
            event(new UserCreated($user));
            $i++;
        }
        $i=1;
        foreach (range(25,29) as $key) {
            $user_data=[
                'id' => $key,
                'username' => '10000'.$key,
                'name' => 'sales-'.$i,
                'email' => 'sales-'.$i.'@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $user = User::create($user_data);
            event(new UserCreated($user));
            $i++;
        }
    }
}
