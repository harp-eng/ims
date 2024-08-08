<?php

namespace Modules\BaseMaterial\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Modules\Ingredient\Models\BaseMaterialIngredient;

class BaseMaterialsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'BaseMaterials';

        // module name
        $this->module_name = 'basematerials';

        // directory path of the module
        $this->module_path = 'basematerial::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = 'Modules\BaseMaterial\Models\BaseMaterial';
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

        $$module_name = $module_model::select('id', 'name', 'status', 'SKU', 'Barcode','QuantityProduced', 'QuantityInStock', 'LeadTimeDays', 'ExpiryDate', 'IsPerishable', 'IsHazardous', 'UnitOfMeasure', 'IsQualityCheck', 'UserID', 'LocationID', 'updated_at');

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('name', '<strong>{{ $name }}</strong>')
            ->editColumn('QuantityInStock', function ($data) {
                return $data->QuantityInStock." ".$data->UnitOfMeasure;
            })
            ->editColumn('QuantityProduced', function ($data) {
                return $data->QuantityProduced." ".$data->UnitOfMeasure;
            })
            ->editColumn('UserID', function ($data) {
                return $data->user?->name ?? '-';
            })
            ->editColumn('LocationID', function ($data) {
                return $data->location?->name ?? '-';
            })
            ->editColumn('status', function($row) {
                // Define the Bootstrap badge class based on status
                $badgeClass = 'badge'; // Base class for badges
                switch($row->status) {
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
                return "<span class='{$badgeClass}'>{$row->status}</span>";
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
                // Handle search queries for UserID and name fields
                if (request()->filled('search.value')) {
                    $searchTerm = request()->input('search.value');
                    $query->where(function ($query) use ($searchTerm) {
                        $query->where('UserID', 'like', '%' . $searchTerm . '%')
                              ->orWhereHas('user', function ($query) use ($searchTerm) {
                                  $query->where('name', 'like', '%' . $searchTerm . '%');
                              });
                    });
                }
            })
            ->rawColumns(['name','status', 'action'])
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
 
         $column_show=['id', 'name', 'status', 'SKU', 'Barcode','QuantityProduced', 'QuantityInStock', 'ExpiryDate', 'IsPerishable', 'IsHazardous', 'UnitOfMeasure', 'IsQualityCheck', 'UserID', 'LocationID', 'updated_at', 'created_at'];
 
         logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);
 
         return view("{$module_path}.{$module_name}.show", compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action','column_show', "{$module_name_singular}"));
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

        // Save related BaseMaterialIngredient records
        if ($request->filled('ingredient_id')) {
            foreach ($request->input('ingredient_id') as $key => $ingredientId) {
                BaseMaterialIngredient::create([
                    'BaseMaterialID' => $$module_name_singular->id,
                    'IngredientID' => $ingredientId,
                    'QuantityUsed' => $request->input('quantity_used')[$key],
                ]);
            }
        }

        flash("New '".Str::singular($module_title)."' Added")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

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

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return view(
            "{$module_path}.{$module_name}.edit",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "{$module_name_singular}")
        );
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

        // Update related BaseMaterialIngredient records
        if ($request->filled('ingredient_id')) {
            // // Delete existing related records (optional, if needed)
            // $$module_name_singular->ingredients()->delete();
            // Create/update related records
            foreach ($request->input('ingredient_id') as $key => $ingredientId) {
                BaseMaterialIngredient::updateOrCreate(
                    [
                        'BaseMaterialID' => $$module_name_singular->id,
                        'IngredientID' => $ingredientId,
                    ],
                    [
                        'QuantityUsed' => $request->input('quantity_used')[$key],
                        // Add other fields here
                    ]
                );
            }
        }

        flash(Str::singular($module_title)."' Updated Successfully")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return redirect()->route("backend.{$module_name}.show", $$module_name_singular->id);
    }
}
