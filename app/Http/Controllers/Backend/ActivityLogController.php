<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Authorizable;
use App\Events\Backend\UserCreated;
use App\Events\Backend\UserUpdated;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserProvider;
use App\Notifications\UserAccountCreated;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;


class ActivityLogController extends Controller
{
    use Authorizable;

    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Activity Log';

        // module name
        $this->module_name = 'activity-log';

        // directory path of the module
        $this->module_path = 'backend';

        // module icon
        $this->module_icon = 'fa-solid fa-user-group';

        // module model name, path
        $this->module_model = 'Spatie\Activitylog\Models\Activity';
    }

    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $page_heading = ucfirst($module_title);
        $title = $page_heading . ' ' . ucfirst($module_action);

        $$module_name = $module_model::paginate();

        logUserAccess($module_title . ' ' . $module_action);

        $roleName = request()->query('role');
        if ($roleName) {
            $module_title = ucfirst($roleName);
        }
        return view("{$module_path}.{$module_name}.index_datatable", compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'page_heading', 'title'));
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

        $$module_name = $module_model::query();

        if (Auth::user()->hasRole('employee')) {
            $$module_name = $$module_name->where('causer_id', Auth::user()->id);
        }
       // $$module_name = $module_model::query();
        
        $data = $$module_name;

        return Datatables::of($$module_name)

           
            ->editColumn('description', function ($data) {
                $changes='';
                if (isset($data->properties['changes']) && empty($data->properties['changes'])) {
                    $changes= "Changes: <br>";
                    foreach ($data->properties['changes'] as $attribute => $change) {
                        $changes = ucfirst($attribute) . ": " . $change['old'] . " -> " . $change['new'] . "<br>";
                    }
                }
                return $data->description." ".$changes;
            })
            ->editColumn('causer_id', function ($data) {
                return $data->causer ? $data->causer->name : '-';
            })
            ->editColumn('subject_id', function ($data) {
                return class_basename($data->subject)." : ".$data->subject->name ?? class_basename($data->subject)."  ".$data->subject->id;
            })
        
            ->editColumn('created_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->created_at);

                if ($diff < 25) {
                    return $data->created_at->diffForHumans();
                }

                return $data->created_at->isoFormat('LLLL');
            })
            ->rawColumns(['id'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }
}

