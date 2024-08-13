<?php

namespace Modules\Transaction\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class TransactionsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Transactions';

        // module name
        $this->module_name = 'transactions';

        // directory path of the module
        $this->module_path = 'transaction::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Transaction\Models\Transaction";
    }

     /**
     * Retrieves the data for the index page of the module.
     *
     * @return Illuminate\Http\JsonResponse
     */
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
        $title = $page_heading.' '.label_case($module_action);

        $$module_name = $module_model::select('id','description','transaction_status','user_id','order_id','payment_method','transaction_date','amount','currency','reference_number', 'updated_at');

        
        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })

            ->editColumn('user_id', function ($data) {
                
                return $data?->user?->name;
            })
            ->editColumn('order_id', function ($data) {
                
                return $data?->order?->Order_number;
            })
            ->editColumn('transaction_status', function($row) {
                // Define the Bootstrap badge class based on status
                $badgeClass = 'badge'; // Base class for badges
                switch($row->transaction_status) {
                    case 'Pending':
                        $badgeClass .= ' bg-primary'; // Blue background
                        break;
                    case 'Completed':
                    case 'succeeded':
                        $badgeClass .= ' bg-success'; // Green background (could be same as Shipped)
                        break;
                    case 'Failed':
                        $badgeClass .= ' bg-danger'; // Red background
                        break;
                    default:
                        $badgeClass .= ' bg-secondary'; // Default to gray
                        break;
                }
                return "<span class='{$badgeClass}'>{$row->transaction_status}</span>";
            })
            
            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                }

                return $data->updated_at->isoFormat('llll');
            })
            ->rawColumns([ 'transaction_status','action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }

}
