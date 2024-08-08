<?php

namespace Modules\TimeSheet\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Modules\TimeSheet\Models\TimeSheet;

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
        $this->module_model = 'Modules\TimeSheet\Models\TimeSheet';
    }

    public function checkIn(Request $request)
    {
        $user = Auth::user();
        $timeSheet = new TimeSheet();
        $timeSheet->employee_id = $user->id;
        $timeSheet->sign_in_time = now();
        $timeSheet->date = now()->toDateString();
        $timeSheet->save();

        return redirect()->back()->with('success', 'Checked in successfully.');
    }

    public function checkOut(Request $request)
    {
        $user = Auth::user();
        $timeSheet = TimeSheet::where('employee_id', $user->id)
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($timeSheet) {
            $timeSheet->sign_out_time = now();
            $timeSheet->save();
        }

        return redirect()->back()->with('success', 'Checked out successfully.');
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
        if (Auth::user()->hasRole('worker')||Auth::user()->hasRole('compounder')) {
            $$module_name = $$module_name->where('employee_id', Auth::user()->id);
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
            ->filter(function ($query) {
                // Handle search queries for employee_id and name fields
                if (request()->filled('search.value')) {
                    $searchTerm = request()->input('search.value');
                    $query->where(function ($query) use ($searchTerm) {
                        $query->where('employee_id', 'like', '%' . $searchTerm . '%')
                              ->orWhereHas('employee', function ($query) use ($searchTerm) {
                                  $query->where('name', 'like', '%' . $searchTerm . '%');
                              });
                    });
                }
            })
            ->rawColumns(['action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }
}
