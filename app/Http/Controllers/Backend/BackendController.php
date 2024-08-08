<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BackendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
{
    $currentDate = Carbon::now()->format('Y-m-d');
    $oneYearAgo = Carbon::now()->subYear()->format('Y-m-d');

    // Query for expired ingredients
    $expiredIngredients = DB::table('ingredients')
        ->select(
            DB::raw('SUM(QuantityInStock) as expired_quantity'),
            DB::raw('DATE_FORMAT(ExpiryDate, "%Y-%m") as y_m'),
            DB::raw('CASE
                    WHEN UnitOfMeasure LIKE "%KG%" THEN "KG"
                    WHEN UnitOfMeasure LIKE "%L%" THEN "Liter"
                    WHEN UnitOfMeasure LIKE "%Bottles%" THEN "Bottles"
                    WHEN UnitOfMeasure LIKE "%Packs%" THEN "Packs"
                    ELSE "Other"
                END as unit'),
        )
        ->where('ExpiryDate', '<', $currentDate)
        ->where('ExpiryDate', '>=', $oneYearAgo)
        ->groupBy(DB::raw('DATE_FORMAT(ExpiryDate, "%Y-%m")'), 'unit')
        ->get();

    // Prepare data for the chart
    $data = [
        'months' => [],
        'kg_data' => [],
        'liter_data' => [],
        'bt_data' => [],
        'pk_data' => [],
    ];

    foreach (range(11, 0) as $i) {
        $monthYear = Carbon::now()->subMonths($i)->format('Y-m');
        $formattedMonthYear = Carbon::parse($monthYear . '-01')->format('F Y');
        $data['months'][] = $formattedMonthYear;
        $data['kg_data'][$formattedMonthYear] = 0;
        $data['liter_data'][$formattedMonthYear] = 0;
        $data['bt_data'][$formattedMonthYear] = 0;
        $data['pk_data'][$formattedMonthYear] = 0;
    }

    foreach ($expiredIngredients as $ingredient) {
        $formattedMonthYear = Carbon::parse($ingredient->y_m . '-01')->format('F Y');
        if ($ingredient->unit == 'KG') {
            $data['kg_data'][$formattedMonthYear] += $ingredient->expired_quantity;
        } elseif ($ingredient->unit == 'Liter') {
            $data['liter_data'][$formattedMonthYear] += $ingredient->expired_quantity;
        } elseif ($ingredient->unit == 'Bottles') {
            $data['bt_data'][$formattedMonthYear] += $ingredient->expired_quantity;
        } elseif ($ingredient->unit == 'Packs') {
            $data['pk_data'][$formattedMonthYear] += $ingredient->expired_quantity;
        }
    }
    $wasted_raw_material = $data;

    //=================base material ==============
    $expiredBaseMaterials = DB::table('basematerials')
        ->select(DB::raw('SUM(QuantityInStock) as total_quantity'), DB::raw('DATE_FORMAT(ExpiryDate, "%Y-%m") as y_m'))
        ->where('ExpiryDate', '<', $currentDate)
        ->where('ExpiryDate', '>=', $oneYearAgo)
        ->groupBy(DB::raw('DATE_FORMAT(ExpiryDate, "%Y-%m")'))
        ->get();

    $data = [
        'months' => [],
        'quantities' => [],
    ];

    foreach (range(11, 0) as $i) {
        $monthYear = Carbon::now()->subMonths($i)->format('Y-m');
        $formattedMonthYear = Carbon::parse($monthYear . '-01')->format('F Y');
        $data['months'][] = $formattedMonthYear;
        $data['quantities'][$formattedMonthYear] = 0;
    }

    foreach ($expiredBaseMaterials as $material) {
        $formattedMonthYear = Carbon::parse($material->y_m . '-01')->format('F Y');
        $data['quantities'][$formattedMonthYear] = $material->total_quantity;
    }
    $wasted_base_material = $data;
    //=============================================

    return view('backend.index', compact('wasted_raw_material', 'wasted_base_material'));
}

}
