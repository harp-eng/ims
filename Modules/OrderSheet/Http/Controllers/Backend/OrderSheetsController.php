<?php

namespace Modules\OrderSheet\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Modules\Order\Models\OrderDetail;
use Modules\Order\Models\BaseMaterialOrder;
use Modules\Order\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TaskEfficiency;

class OrderSheetsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'OrderSheets';

        // module name
        $this->module_name = 'ordersheets';

        // directory path of the module
        $this->module_path = 'ordersheet::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = 'Modules\OrderSheet\Models\OrderSheet';
    }

    public function index_data()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $page_heading = label_case($module_title);
        $title = $page_heading . ' ' . label_case($module_action);
        $$module_name = $module_model::select('id', 'name', 'order_item_id', 'status', 'worker_id', 'helper_id', 'items_covered', 'base_material_id', 'updated_at');

        if (request()->query('id')) {
            $$module_name = $$module_name->where('IngredientID', request()->query('id'));
        }
        if (Auth::user()->hasRole('worker') || Auth::user()->hasRole('compounder')) {
            $$module_name = $$module_name->where(function ($query) {
                $query->where('worker_id', Auth::user()->id)->orWhere('helper_id', Auth::user()->id);
            });
        }

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->addColumn('order_name', function ($data) {
                return $data?->orderItem?->order?->Order_number;
            })

            ->editColumn('status', function ($data) {
                $statusOptions = ['pending', 'filled', 'labelled', 'packed'];
                $options = '<select class="status-select" id="status_' . $data->id . '" data-id="' . $data->id . '">';
                foreach ($statusOptions as $option) {
                    $selected = $data->status == $option ? 'selected' : '';
                    $options .= '<option value="' . $option . '" ' . $selected . '>' . ucfirst($option) . '</option>';
                }
                $options .= '</select>';
                if (Auth::user()->hasRole('worker')) {
                    $label = '';
                    $status = '';
                    switch ($data->status) {
                        case 'pending':
                            $label = 'Mark as Filled';
                            $status = 'filled';
                            break;
                        case 'filled':
                            $label = 'Mark as Labelled';
                            // Additional code for 'filled' status
                            $status = 'labelled';
                            break;
                        case 'labelled':
                            $label = 'Mark as Packed';
                            $status = 'packed';
                            break;
                    }
                    $options = '<button type="button" data-status="' . $status . '"  id="status_' . $data->id . '" data-id="' . $data->id . '" class="btn btn-primary status-select">' . $label . '</button>';
                }

                // Base Material select box (hidden initially)
                $baseMaterials = \Modules\BaseMaterial\Models\BaseMaterial::all(); // Replace with your model and query
                $baseMaterialOptions = '<div class="outer_div"  style="display: none;"><label for="base_material_id_' . $data->id . '">Base Material Used:</label><select class="base-material-select" id="base_metrial_used_' . $data->id . '" data-id="' . $data->id . '">';
                $baseMaterialOptions .= '<option value="">Select Base Material</option>';
                foreach ($baseMaterials as $material) {
                    $baseMaterialOptions .= '<option value="' . $material->id . '">' . $material->name . '</option>';
                }
                $baseMaterialOptions .= '</select></div>';

                return $options . $baseMaterialOptions;
            })
            ->editColumn('worker_id', function ($data) {
                $workers = \App\Models\User::role('worker')->get(); // Fetch all workers
                $options = '<option value="">Select Worker</option>';
                foreach ($workers as $worker) {
                    $selected = $data->worker_id == $worker->id ? 'selected' : '';
                    $options .= "<option value='{$worker->id}' {$selected}>{$worker->name}</option>";
                }
                return "<select class='worker-select' data-id='{$data->id}' data-column='worker_id'>{$options}</select>";
            })
            ->editColumn('helper_id', function ($data) {
                $workers = \App\Models\User::role('worker')->get(); // Fetch all workers
                $options = '<option value="">Select Worker</option>';
                foreach ($workers as $worker) {
                    $selected = $data->helper_id == $worker->id ? 'selected' : '';
                    $options .= "<option value='{$worker->id}' {$selected}>{$worker->name}</option>";
                }
                return "<select class='worker-select' data-id='{$data->id}' data-column='helper_id'>{$options}</select>";
            })
            ->editColumn('base_material_id', function ($data) {
                return $data->baseMaterial?->name ?? '-';
            })
            ->editColumn('order_item_id', function ($data) {
                return $data->orderItem?->product->name ?? '-';
            })
            ->editColumn('items_covered', function ($data) {
                return $data->items_covered ?? '-';
            })
            ->editColumn('quantity', function ($data) {
                return $data->orderItem?->Quantity ?? '-';
            })
            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                }

                return $data->updated_at->isoFormat('llll');
            })
            ->rawColumns(['helper_id', 'status', 'worker_id', 'action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }

    public function updateWorkerId(Request $request)
    {
        $module_model = $this->module_model;
        $request->validate([
            'order_id' => 'required|exists:ordersheets,id',
            'worker_id' => 'nullable|exists:users,id',
            'column' => 'required',
        ]);
        $column = $request->column;
        $module_name_singular = $module_model::find($request->order_id);
        $module_name_singular->$column = $request->worker_id;
        $module_name_singular->save();

        $changes = $module_name_singular;

        activity()
            ->performedOn($module_name_singular)
            ->when(isset($changes) && !empty($changes), function ($activity) use ($changes) {
                $activity->withProperties(['changes' => $changes]);
            })
            ->event('Order Sheet Assigned To Worker')
            ->log($module_name_singular->name . ' asigned to ' . $module_name_singular->worker->name);

        return response()->json(['success' => true]);
    }

    public function updateOrderInfo(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_action = 'Order Sheet Status Update';
        // Validate request data as needed
        $module_model = $this->module_model;
        $order = $module_model::findOrFail($request->order_id);

        $order->status = $request->status;
        $message = 'Status changed to ' . $order->status . '.';
        if ($request->base_material_id) {
            $order->base_material_id = $request->base_material_id;
            $order->quantity_used = $request->quantity_used;
            $message .= ' Base Metrial Used: ' . $order->baseMaterial->name . ' Quantity: ' . $order->quantity_used . 'Kg';

            BaseMaterialOrder::updateOrCreate(
                [
                    'BaseMaterialID' => $order->base_material_id,
                    'orderDetailID' => $order->order_item_id,
                ],
                [
                    'QuantityUsed' => $request->quantity_used ?? 0,
                    // Add other fields here
                ],
            );
        }
        $time_taken = getTimeTakenToday($order->worker_id);
        // Insert a new entry into the worker_performances table
        $task = maptask($order->status);
        if ($order->worker_id) {
            

            DB::table('worker_performances')->insert([
                'worker_id' => $order->worker_id,
                'task_name' => $task,
                'task_time_taken' => $time_taken,
                'quality_of_work' => 10,
                'quantity' => $order->orderItem->Quantity,
                'efficiency' => 0, // Optional efficiency calculation
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            TaskEfficiency::updateOrCreate(
                [
                    'user_id' => $order->worker_id,
                    'task_name' => $task,
                ]
            );
        }
        $order->worker_id = null;
        $order->helper_id = null;
        $order->save();

        checkEff($task);

        activity()->performedOn($order)->withProperties($order)->event($module_action)->log($message);

        return response()->json(['success' => true]);
    }
}
