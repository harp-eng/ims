<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;
use App\Notifications\IngredientNotification;
use App\Notifications\BaseMaterialNotification;
use App\Models\User;

class UpdateIngredientStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-ingredient-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the current date
        $now = Carbon::now();

        // Update statuses based on conditions

        // Status 'No Stock'
        DB::table('ingredients')
            ->where('QuantityInStock', '<=', 0)
            ->update(['status' => 'No Stock']);

        // Status 'Low Stock'
        DB::table('ingredients')
            ->where('QuantityInStock', '>', 0)
            ->whereColumn('QuantityInStock', '<=', 'SafetyStockLevel')
            ->update(['status' => 'Low Stock']);

        // Status 'Expired'
        DB::table('ingredients')
            ->where('ExpiryDate', '<', $now)
            ->update(['status' => 'Expired']);

        // Status 'In Stock'
        DB::table('ingredients')
            ->where('QuantityInStock', '>', 0)
            ->where('QuantityInStock', '>', DB::raw('SafetyStockLevel'))
            ->where('ExpiryDate', '>=', $now)
            ->update(['status' => 'In Stock']);

        //=================for base material================

        // Status 'No Stock'
        DB::table('basematerials')
            ->where('QuantityInStock', '<=', 0)
            ->update(['status' => 'No Stock']);

        // Status 'Low Stock'
        DB::table('basematerials')
            ->where('QuantityInStock', '>', 0)
            ->where('QuantityInStock', '<=', 10)
            ->update(['status' => 'Low Stock']);

        // Status 'Expired'
        DB::table('basematerials')
            ->where('ExpiryDate', '<', $now)
            ->update(['status' => 'Expired']);

        // Status 'In Stock'
        DB::table('basematerials')
            ->where('QuantityInStock', '>', 0)
            ->where('QuantityInStock', '>', 10)
            ->where('ExpiryDate', '>=', $now)
            ->update(['status' => 'In Stock']);

        // Add more conditions as needed...

        // Fetch ingredients with stock below the threshold
        $Ingredients = DB::table('ingredients')
            ->whereIn('status', ['No Stock', 'Low Stock', 'Expired'])
            ->get();

        // Fetch users who should receive notifications
        $users = User::role('manager')->get(); // Adjust the role based on your user setup

        foreach ($Ingredients as $ingredient) {
            foreach ($users as $user) {
                $notificationExists = DB::table('notifications')
                    ->where('notifiable_id', $user->id)
                    ->where('type', IngredientNotification::class)
                    ->where('data', 'like', '%"ingredient_id":' . $ingredient->id . '%')
                    ->exists();

                if (!$notificationExists) {
                    $user->notify(new IngredientNotification($ingredient));
                }
            }
        }

        // Fetch ingredients with stock below the threshold
        $basematerials = DB::table('basematerials')
            ->whereIn('status', ['No Stock', 'Low Stock', 'Expired'])
            ->get();

        foreach ($basematerials as $basematerial) {
            foreach ($users as $user) {
                $notificationExists = DB::table('notifications')
                    ->where('notifiable_id', $user->id)
                    ->where('type', BaseMaterialNotification::class)
                    ->where('data', 'like', '%"basematerial_id":' . $basematerial->id . '%')
                    ->exists();

                if (!$notificationExists) {
                    $user->notify(new BaseMaterialNotification($basematerial));
                }
            }
        }

        $this->info('Low stock notifications for ingredients sent successfully.');

        $this->info('Ingredient statuses have been updated successfully.');
    }
}
