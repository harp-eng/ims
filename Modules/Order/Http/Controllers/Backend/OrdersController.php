<?php

namespace Modules\Order\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Modules\Order\Models\OrderDetail;
use Modules\Order\Models\Address;

class OrdersController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Orders';

        // module name
        $this->module_name = 'orders';

        // directory path of the module
        $this->module_path = 'order::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = 'Modules\Order\Models\Order';
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
        $$module_name = $module_model::select('id', 'status', 'CustomerID', 'OrderDate', 'ShipDate', 'TotalAmount', 'updated_at');

        if (request()->query('id')) {
            $$module_name = $$module_name->where('IngredientID', request()->query('id'));
        }

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('CustomerID', function ($data) {
                return $data->customer?->name ?? '-';
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

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        $column_show = ['id', 'status', 'CustomerID', 'OrderDate', 'ShipDate', 'TotalAmount', 'ShippingAddressID', 'BillingAddressID', 'updated_at', 'created_at'];

        $orderDetails = OrderDetail::where('OrderID', $id)->get();

        return view("{$module_path}.{$module_name}.show", compact('module_title', 'module_name', 'module_path', 'module_icon', 'orderDetails', 'column_show', 'module_name_singular', 'module_action', "{$module_name_singular}"));
    }

    public function fetchCustomerAddresses($customerId)
    {
        // Fetch shipping and billing addresses for the customer
        $addresses = Address::where('EntityID', $customerId)->where('EntityType', 'Customer')->get();

        // Prepare addresses for JSON response
        $formattedAddresses = $addresses->map(function ($address) {
            return [
                'id' => $address->id,
                'address_line1' => $address->AddressLine1,
                'address_line2' => $address->AddressLine2 ?? '-',
                'city' => $address->City,
                'state' => $address->State,
                'zip_code' => $address->ZipCode,
            ];
        });
        return response()->json([
            'addresses' => $formattedAddresses,
        ]);
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

        // Update related OrderDetail records
        if ($request->filled('ProductID')) {
            // $$module_name_singular->ingredients()->delete();
            // Create/update related records
            foreach ($request->input('ProductID') as $key => $productId) {
                OrderDetail::updateOrCreate(
                    [
                        'OrderID' => $$module_name_singular->id,
                        'ProductID' => $productId,
                    ],
                    [
                        'Quantity' => $request->input('Quantity')[$key],
                        'UnitPrice' => $request->input('UnitPrice')[$key],
                        'TotalPrice' => $request->input('TotalPrice')[$key],
                        'status' => 'Pending',
                        // Add other fields here
                    ],
                );
            }
        }
        flash("New '" . Str::singular($module_title) . "' Added")
            ->success()
            ->important();

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

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

        // Update related OrderDetail records
        if ($request->filled('ProductID')) {
            // $$module_name_singular->ingredients()->delete();
            // Create/update related records
            foreach ($request->input('ProductID') as $key => $productId) {
                OrderDetail::updateOrCreate(
                    [
                        'OrderID' => $$module_name_singular->id,
                        'ProductID' => $productId,
                    ],
                    [
                        'Quantity' => $request->input('Quantity')[$key],
                        'UnitPrice' => $request->input('UnitPrice')[$key],
                        'TotalPrice' => $request->input('TotalPrice')[$key],
                        // Add other fields here
                    ],
                );
            }
        }

        flash(Str::singular($module_title) . "' Updated Successfully")
            ->success()
            ->important();

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        return redirect()->route("backend.{$module_name}.show", $$module_name_singular->id);
    }
}
