<?php

namespace Modules\TimeSheet\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class TimeSheetsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'TimeSheets';

        // module name
        $this->module_name = 'timesheets';

        // directory path of the module
        $this->module_path = 'timesheet::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\TimeSheet\Models\TimeSheet";
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
        $$module_name = $module_model::select('id', 'employee_id', 'sign_in_time', 'sign_out_time', 'date', 'duration', 'updated_at');
        if (request()->query('id')) {
            $$module_name = $$module_name->where('employee_id', request()->query('id'));
        }

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('employee_id', function ($data) {
                return $data->employee?->name ?? '-';
            })
            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                }

                return $data->updated_at->isoFormat('llll');
            })
            ->rawColumns(['action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }
}