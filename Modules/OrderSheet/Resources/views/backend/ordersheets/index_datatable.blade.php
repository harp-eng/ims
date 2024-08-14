@extends('backend.layouts.app')

@section('title')
    {{ __($module_action) }} {{ __($module_title) }}
@endsection

@section('breadcrumbs')
    <x-backend.breadcrumbs>
        <x-backend.breadcrumb-item type="active"
            icon='{{ $module_icon }}'>{{ __($module_title) }}</x-backend.breadcrumb-item>
    </x-backend.breadcrumbs>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <x-backend.section-header>
                <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small
                    class="text-muted">{{ __($module_action) }}</small>

                <x-slot name="subtitle">
                    @lang(':module_name Management Dashboard', ['module_name' => Str::title($module_name)])
                </x-slot>
                <x-slot name="toolbar">
                    @can('add_' . $module_name)
                        <x-buttons.create route='{{ route("backend.$module_name.create") }}'
                            title="{{ __('Create') }} {{ ucwords(Str::singular($module_name)) }}" />
                    @endcan

                    @can('restore_' . $module_name)
                        <div class="btn-group">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-coreui-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href='{{ route("backend.$module_name.trashed") }}'>
                                        <i class="fas fa-eye-slash"></i> @lang('View trash')
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
                                    Name
                                </th>
                                <th>
                                    Order Name
                                </th>
                                <th>
                                    Order Item
                                </th>
                                <th>Quantity</th>
                                <th>Status</th>
                                @can('add_' . $module_name)
                                    <th>Worker</th>
                                    <th>Helper</th>
                                @endcan
                                <th>Material Used</th>
                                <th>Items Covered</th>
                                <th>
                                    @lang('ordersheet::text.updated_at')
                                </th>
                                <th class="text-end">
                                    @lang('ordersheet::text.action')
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

@push('after-styles')
    <!-- DataTables Core and Extensions -->
    <link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">
@endpush

@push('after-scripts')
    <!-- DataTables Core and Extensions -->
    <script type="module" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>

    <script type="module">
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ route("backend.$module_name.index_data") }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },{
                    data: 'order_name',
                    name: 'order_name'
                },
                {
                    data: 'order_item_id',
                    name: 'order_item_id'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                @can('add_' . $module_name)
                    {
                        data: 'worker_id',
                        name: 'worker_id'
                    }, {
                        data: 'helper_id',
                        name: 'helper_id'
                    },
                @endcan {
                    data: 'base_material_id',
                    name: 'base_material_id'
                },
                {
                    data: 'items_covered',
                    name: 'items_covered'
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

        // Handle change event of status select boxes
        $(document).on('change click', '.status-select', function() {
            var orderId = $(this).data('id');
            var status = $(this).val() || $(this).data('status');

            // Reset additional fields
            $('.additional-fields').remove();



            // If status is 'filled', show additional fields
            if (status === 'filled') {
                var additionalFields = '<div class="additional-fields">';

                additionalFields += '<label for="quantity_used_' + orderId + '">Quantity Used:</label>';
                additionalFields += '<input type="text" name="quantity_used_' + orderId + '" id="quantity_used_' +
                    orderId + '">';

                additionalFields += '</div>';

                var updateButton = '<button class="btn btn-primary update-btn" data-id="' + orderId +
                    '">Update</button>';

                $(this).closest('td').append(additionalFields);
                $(this).closest('td').append(updateButton);
                var baseMaterialSelect = $(this).closest('td').find('.outer_div');
                baseMaterialSelect.show();
            } else {
                var baseMaterialSelect = $(this).closest('td').find('.outer_div');
                baseMaterialSelect.hide();
                updateStatus($(this));
            }

            // You can add AJAX logic here to update the status in the database if needed
            // For simplicity, this example does not include AJAX for updating status
        });

        function updateStatus(me) {
            var orderId = me.data('id');
            var quantityUsed = $('#quantity_used_' + orderId).val();
            var status = $('#status_' + orderId).val() || $('#status_' + orderId).data('status');
            var base_material_id = $('#base_metrial_used_' + orderId).val();

            // Perform AJAX update
            $.ajax({
                url: '{{ route("backend.$module_name.updateOrderInfo") }}', // Update with your route
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    order_id: orderId,
                    quantity_used: quantityUsed,
                    status: status,
                    base_material_id: base_material_id
                    // Add other fields as needed
                },
                success: function(response) {
                    //location.reload();
                    // Optionally, update the DataTable or refresh data as needed
                },
                error: function(xhr, status, error) {
                    //location.reload();
                }
            });
        }
        // Handle click event of update button
        $(document).on('click', '.update-btn', function() {
            updateStatus($(this));
        });
        $(document).ready(function() {
            // Handle change event of worker select boxes
            $(document).on('change', '.worker-select', function() {
                var orderId = $(this).data('id');
                var workerId = $(this).val();
                var column = $(this).data('column');

                $.ajax({
                    url: '{{ route('backend.ordersheets.updateWorkerId') }}', // Update with your route
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        order_id: orderId,
                        worker_id: workerId,
                        column: column,
                    },
                    success: function(response) {
                        alert('Worker ID updated successfully.');
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while updating the worker ID.');
                    }
                });
            });
        });
    </script>
@endpush
