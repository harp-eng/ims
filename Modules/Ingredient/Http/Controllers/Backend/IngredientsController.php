<?php

namespace Modules\Ingredient\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class IngredientsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Ingredients';

        // module name
        $this->module_name = 'ingredients';

        // directory path of the module
        $this->module_path = 'ingredient::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = 'Modules\Ingredient\Models\Ingredient';
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
        $title = $page_heading . ' ' . label_case($module_action);

        $$module_name = $module_model::select('id', 'SupplierID', 'LocationID', 'QuantityInStock', 'PurchaseDate', 'ExpiryDate', 'QuantityPurchased', 'UnitPrice', 'TotalPrice', 'name', 'ExpiryDate', 'UnitOfMeasure', 'Status', 'QuantityInStock', 'updated_at', 'SafetyStockLevel');

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('name', '<strong>{{ $name }}</strong>')
            ->editColumn('QuantityPurchased', '{{ $QuantityPurchased }} {{ $UnitOfMeasure }}')
            ->editColumn('QuantityInStock', '{{ $QuantityInStock }} {{ $UnitOfMeasure }}')
            ->editColumn('Status', function($row) {
                // Define the Bootstrap badge class based on status
                $badgeClass = 'badge'; // Base class for badges
                switch($row->Status) {
                    case 'Low Stock':
                        $badgeClass .= ' bg-warning'; // Yellow background
                        break;
                    case 'No Stock':
                        $badgeClass .= ' bg-danger'; // Red background
                        break;
                    case 'In Stock':
                        $badgeClass .= ' bg-success'; // Green background
                        break;
                    case 'Expired':
                        $badgeClass .= ' bg-danger'; // Red background (could be same as No Stock)
                        break;
                    case 'On Order':
                        $badgeClass .= ' bg-info'; // Light blue background
                        break;
                    case 'Overstocked':
                        $badgeClass .= ' bg-primary'; // Blue background
                        break;
                    case 'Discontinued':
                        $badgeClass .= ' bg-secondary'; // Gray background
                        break;
                    case 'Damaged':
                        $badgeClass .= ' bg-dark'; // Dark background
                        break;
                    default:
                        $badgeClass .= ' bg-secondary'; // Default to gray
                        break;
                }
                return "<span class='{$badgeClass}'>{$row->Status}</span>";
            })
            

            ->editColumn('SupplierID', function ($data) {
                return $data->supplier?->ContactName ?? '-';
            })
            ->editColumn('LocationID', function ($data) {
                return $data->location?->name ?? '-';
            })
            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                }

                return $data->updated_at->isoFormat('llll');
            })
            ->rawColumns(['name','Status', 'action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */

    public function show($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Show';

        $$module_name_singular = $module_model::findOrFail($id);

        $column_show = ['id', 'name', 'status', 'updated_at', 'UnitOfMeasure', 'created_at', 'QuantityInStock', 'ExpiryDate', 'IsPerishable', 'IsHazardous', 'Notes'];

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        return view("{$module_path}.{$module_name}.show", compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', 'column_show', "{$module_name_singular}"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Create';

        logUserAccess($module_title . ' ' . $module_action);

        return view("{$module_path}.{$module_name}.create", compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action'));
    }

    /**
     * Store a new resource in the database.
     *
     * @param  Request  $request  The request object containing the data to be stored.
     * @return RedirectResponse The response object that redirects to the index page of the module.
     *
     * @throws Exception If there is an error during the creation of the resource.
     */
    public function store(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';

        $$module_name_singular = $module_model::create($request->all());

        flash("New '" . Str::singular($module_title) . "' Added")
            ->success()
            ->important();

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        activity()
            ->withProperties($$module_name_singular)
            ->performedOn($$module_name_singular)
            ->event($module_title . ' ' . $module_action)
            ->log($module_title . ' ' . $module_action);

        return redirect("admin/{$module_name}");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Edit';

        $$module_name_singular = $module_model::findOrFail($id);

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        return view("{$module_path}.{$module_name}.edit", compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "{$module_name_singular}"));
    }

    /**
     * Updates a resource.
     *
     * @param  int  $id
     * @param  Request  $request  The request object.
     * @param  mixed  $id  The ID of the resource to update.
     * @return Response
     * @return RedirectResponse The redirect response.
     *
     * @throws ModelNotFoundException If the resource is not found.
     */
    public function update(Request $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $$module_name_singular = $module_model::findOrFail($id);
        $$module_name_singular->update($request->all());

        flash(Str::singular($module_title) . "' Updated Successfully")
            ->success()
            ->important();

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        activity()
            ->performedOn($$module_name_singular)
            ->withProperties($$module_name_singular)
            ->event($module_title . ' ' . $module_action)
            ->log($module_title . ' ' . $module_action . ' => ' . $module_title . ' name: ' . $$module_name_singular->name);

        return redirect()->route("backend.{$module_name}.show", $$module_name_singular->id);
    }

    /**
     * Destroys a record from the database.
     *
     * @param  int  $id
     * @param  int  $id  The ID of the record to be destroyed.
     * @return Response
     * @return \Illuminate\Http\RedirectResponse Redirects the user to the specified URL.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record is not found.
     */
    public function destroy($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'destroy';

        $$module_name_singular = $module_model::findOrFail($id);

        $$module_name_singular->delete();

        flash(label_case($module_name_singular) . ' Deleted Successfully!')
            ->success()
            ->important();

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        activity()
            ->withProperties($$module_name_singular)
            ->performedOn($$module_name_singular)
            ->event($module_title . ' ' . $module_action)
            ->log($module_title . ' ' . $module_action . ' => ' . $module_title . ' name: ' . $$module_name_singular->name);

        return redirect("admin/{$module_name}");
    }

    /**
     * List of trashed ertries
     * works if the softdelete is enabled.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function trashed()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Trash List';

        $$module_name = $module_model::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate();

        logUserAccess($module_title . ' ' . $module_action);

        return view("{$module_path}.{$module_name}.trash", compact('module_title', 'module_name', 'module_path', "{$module_name}", 'module_icon', 'module_name_singular', 'module_action'));
    }

    /**
     * Restores a data entry in the database.
     *
     * @param  Request  $request
     * @param  int  $id
     * @param  int  $id  The ID of the data entry to be restored.
     * @return Response
     * @return \Illuminate\Http\RedirectResponse The response redirecting to the admin page of the module.
     *
     * @throws \Exception If the data entry cannot be found or restored.
     */
    public function restore($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Restore';

        $$module_name_singular = $module_model::withTrashed()->find($id);
        $$module_name_singular->restore();

        flash(label_case($module_name_singular) . ' Data Restoreded Successfully!')
            ->success()
            ->important();

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        activity()
            ->withProperties($$module_name_singular)
            ->performedOn($$module_name_singular)
            ->event($module_title . ' ' . $module_action)
            ->log($module_title . ' ' . $module_action . ' => ' . $module_title . ' name: ' . $$module_name_singular->name);

        return redirect("admin/{$module_name}");
    }
}
