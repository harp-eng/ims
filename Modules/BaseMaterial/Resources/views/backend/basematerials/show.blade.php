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
<x-backend.layouts.show :data="$$module_name_singular" :module_name="$module_name" :module_path="$module_path" :column_show="$column_show" :module_title="$module_title" :module_icon="$module_icon" :module_action="$module_action" />


<div class="card">
    <div class="card-body">
        <div class="container">
        <h4>Use History</h4>
    
        <!-- DataTable -->
        <table id="useHistoryTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Base Material</th>
                    <th>Quantity Used</th>
                    <th>Left Quantity</th>
                    <th>Created At</th>
                    <th>Created By</th>
                </tr>
            </thead>
            <tbody>
                @if($$module_name_singular->useHistory)
                @foreach($$module_name_singular->useHistory as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->baseMaterial?->name }}</td>
                        <td>{{ number_format($item->QuantityUsed, 2).' '.$$module_name_singular->UnitOfMeasure }}</td>
                        <td>{{ number_format($item->LeftQuantity, 2).' '.$$module_name_singular->UnitOfMeasure }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->creator?->name }}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
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
        $(document).ready(function() {
            $('#useHistoryTable').DataTable({
                "order": [[0, 'desc']] // Assumes 'id' is in the first column (index 0)
            });
        });
    </script>
    @endpush