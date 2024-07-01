@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}'>
        {{ __($module_title) }}
    </x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item type="active">{{ __($module_action) }}</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<x-backend.layouts.show :data="$$module_name_singular" :module_name="$module_name" :module_path="$module_path" :module_title="$module_title" :module_icon="$module_icon" :module_action="$module_action" :column_show="$column_show"/>
@php
$module_name='rawmaterialpurchases';
@endphp
<div class="card">
    <div class="card-body">

        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="subtitle">
                @lang(":module_name Management Dashboard", ['module_name'=>Str::title($module_name)])
            </x-slot>
            <x-slot name="toolbar">
                @can('add_'.$module_name)
                <x-buttons.create route='{{ route("backend.$module_name.create") }}' title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}" />
                @endcan

                @can('restore_'.$module_name)
                <div class="btn-group">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-coreui-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href='{{ route("backend.$module_name.trashed") }}'>
                                <i class="fas fa-eye-slash"></i> @lang("View trash")
                            </a>
                        </li>
                        <!-- <li>
                            <hr class="dropdown-divider">
                        </li> -->
                    </ul>
                </div>
                @endcan
            </x-slot>
        </x-backend.section-header>

        <div class="row mt-4">
            <div class="col">
                <table id="datatable" class="table table-bordered table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                @lang("rawmaterialpurchase::text.Supplier")
                            </th>
                            <th>
                                @lang("rawmaterialpurchase::text.Location")
                            </th>
                            <th>
                                @lang("rawmaterialpurchase::text.PurchaseDate")
                            </th>
                            <th>
                                @lang("rawmaterialpurchase::text.QuantityPurchased")
                            </th>
                            <th>
                                @lang("rawmaterialpurchase::text.QuantityUsed")
                            </th>
                            <th>
                                @lang("rawmaterialpurchase::text.TotalPrice")
                            </th>
                            <th>
                                @lang("rawmaterialpurchase::text.DeliveryDate")
                            </th>
                            <th>
                                @lang("rawmaterialpurchase::text.ExpiryDate")
                            </th>
                            <th>
                                @lang("rawmaterialpurchase::text.updated_at")
                            </th>
                            <th class="text-end">
                                @lang("rawmaterialpurchase::text.action")
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">

                </div>
            </div>
            <div class="col-5">
                <div class="float-end">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push ('after-styles')
<!-- DataTables Core and Extensions -->
<link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">
@endpush

@push ('after-scripts')
<!-- DataTables Core and Extensions -->
<script type="module" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>

<script type="module">
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route("backend.".$module_name.".index_data",["id"=>$$module_name_singular->id]) }}',
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'SupplierID',
                name: 'SupplierID'
            },
            {
                data: 'LocationID',
                name: 'LocationID'
            },
            {
                data: 'PurchaseDate',
                name: 'PurchaseDate'
            },
            {
                data: 'QuantityPurchased',
                name: 'QuantityPurchased'
            },
            {
                data: 'QuantityUsed',
                name: 'QuantityUsed'
            },{
                data: 'TotalPrice',
                name: 'TotalPrice'
            },{
                data: 'DeliveryDate',
                name: 'DeliveryDate'
            },{
                data: 'ExpiryDate',
                name: 'ExpiryDate'
            },
            {
                data: 'updated_at',
                name: 'updated_at'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });
</script>
@endpush