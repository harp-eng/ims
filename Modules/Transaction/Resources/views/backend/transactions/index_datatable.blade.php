@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item type="active" icon='{{ $module_icon }}'>{{ __($module_title) }}</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="subtitle">
                @lang(":module_name Management Dashboard", ['module_name'=>Str::title($module_name)])
            </x-slot>
            <x-slot name="toolbar">
               
                
            </x-slot>
        </x-backend.section-header>

        <div class="row mt-4">
            <div class="col">
                <table id="datatable" class="table table-bordered table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th>@lang("ID")</th>
                            <th>@lang("Description")</th>
                            <th>@lang("Status")</th>
                            <th>@lang("User ID")</th>
                            <th>@lang("Order ID")</th>
                            <th>@lang("Payment Method")</th>
                            <th>@lang("Transaction Date")</th>
                            <th>@lang("Amount")</th>
                            <th>@lang("Currency")</th>
                            <th>@lang("Reference Number")</th>
                            <th>@lang("Updated At")</th>
                            
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
                    <!-- Additional content if needed -->
                </div>
            </div>
            <div class="col-5">
                <div class="float-end">
                    <!-- Additional content if needed -->
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
        ajax: '{{ route("backend.$module_name.index_data") }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'description', name: 'description' },
            { data: 'transaction_status', name: 'transaction_status' },
            { data: 'user_id', name: 'user_id' },
            { data: 'order_id', name: 'order_id' },
            { data: 'payment_method', name: 'payment_method' },
            { data: 'transaction_date', name: 'transaction_date' },
            { data: 'amount', name: 'amount' },
            { data: 'currency', name: 'currency' },
            { data: 'reference_number', name: 'reference_number' },
            { data: 'updated_at', name: 'updated_at' },
            
        ]
    });
</script>
@endpush
