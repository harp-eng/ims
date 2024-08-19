@extends ('backend.layouts.app')

@section('title')
    {{ $$module_name_singular->name }} - {{ $$module_name_singular->username }} - {{ __($module_action) }}
    {{ __($module_title) }}
@endsection

@section('breadcrumbs')
    <x-backend.breadcrumbs>
        <x-backend.breadcrumb-item route='{{ route("backend.$module_name.index") }}' icon='{{ $module_icon }}'>
            {{ $$module_name_singular->name }}
        </x-backend.breadcrumb-item>

        <x-backend.breadcrumb-item type="active">{{ __($module_title) }}
            {{ __($module_action) }}</x-backend.breadcrumb-item>
    </x-backend.breadcrumbs>
@endsection

@section('content')
    <x-backend.layouts.show :data="$user">

        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i> {{ $$module_name_singular->name }} <small class="text-muted">{{ __($module_title) }}
                {{ __($module_action) }}</small>

            <x-slot name="toolbar">
                <x-backend.buttons.return-back :small=true />
                <a class="btn btn-primary btn-sm m-1" data-toggle="tooltip" href="{{ route('backend.users.index') }}"
                    title="List"><i class="fas fa-list"></i> List</a>
                <x-buttons.edit title="{{ __('Edit') }} {{ ucwords(Str::singular($module_name)) }}"
                    route='{!! route("backend.$module_name.edit", $$module_name_singular) !!}' :small=true />
            </x-slot>
        </x-backend.section-header>

        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table-bordered table-hover table">
                        

                        @php
                            $fields_array = [
                                ['name' => 'username', 'type' => 'text'],
                                ['name' => 'name', 'type' => 'text'],
                                ['name' => 'email', 'type' => 'text'],
                                ['name' => 'mobile', 'type' => 'text'],
                                ['name' => 'gender', 'type' => 'text'],
                                ['name' => 'date_of_birth', 'type' => 'date'],
                                ['name' => 'address', 'type' => 'text'],
                                ['name' => 'bio', 'type' => 'text'],
                                ['name' => 'last_ip', 'type' => 'text'],
                                ['name' => 'login_count', 'type' => 'text'],
                                ['name' => 'last_login', 'type' => 'datetime'],
                            ];
                        @endphp

                        @foreach ($fields_array as $item)
                            @php
                                $field_name = $item['name'];
                            @endphp
                            <tr>
                                <th>{{ __(label_case($field_name)) }}</th>
                                <td>{{ $user->$field_name }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>{{ __('labels.backend.users.fields.password') }}</th>
                            <td>
                                <a class="btn btn-outline-primary btn-sm"
                                    href="{{ route('backend.users.changePassword', $user->id) }}">Change password</a>
                            </td>
                        </tr>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.social') }}</th>
                            <td>
                                <ul class="list-unstyled">
                                    @foreach ($user->providers as $provider)
                                        <li>
                                            <i class="fab fa-{{ $provider->provider }}"></i>
                                            {{ label_case($provider->provider) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.status') }}</th>
                            <td>{!! $user->status_label !!}</td>
                        </tr>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.confirmed') }}</th>
                            <td>
                                {!! $user->confirmed_label !!}
                                @if ($user->email_verified_at == null)
                                    <a class="btn btn-primary btn-sm mt-1" data-toggle="tooltip"
                                        href="{{ route('backend.users.emailConfirmationResend', $user->id) }}"
                                        title="Send Confirmation Email"><i class="fas fa-envelope"></i> Send Confirmation
                                        Reminder</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('labels.backend.users.fields.roles') }}</th>
                            <td>
                                @if ($user->getRoleNames()->count() > 0)
                                    <ul>
                                        @foreach ($user->getRoleNames() as $role)
                                            <li>{{ ucwords($role) }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <th>{{ __('labels.backend.users.fields.permissions') }}</th>
                            <td>
                                @if ($user->getAllPermissions()->count() > 0)
                                    <ul>
                                        @foreach ($user->getAllPermissions() as $permission)
                                            <li>{{ $permission->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.created_at') }}</th>
                            <td>{{ $user->created_at }} by
                                User:{{ $user->created_by }}<br><small>({{ $user->created_at->diffForHumans() }})</small>
                            </td>
                        </tr>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.updated_at') }}</th>
                            <td>{{ $user->updated_at }} by
                                User:{{ $user->updated_by }}<br /><small>({{ $user->updated_at->diffForHumans() }})</small>
                            </td>
                        </tr>

                        <tr>
                            <th>{{ __('Deleted At') }}</th>
                            <td>
                                @if ($user->deleted_at != null)
                                    {{ $user->deleted_at }} by
                                    User:{{ $user->deleted_by }}<br /><small>({{ $user->deleted_at->diffForHumans() }})</small>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="py-4 text-end">
                    @if ($user->status != 2)
                        <a class="btn btn-danger mt-1" data-method="PATCH" data-token="{{ csrf_token() }}"
                            data-toggle="tooltip" data-confirm="Are you sure?"
                            href="{{ route('backend.users.block', $user) }}" title="{{ __('labels.backend.block') }}"><i
                                class="fas fa-ban"></i> @lang('Block')</a>
                    @endif
                    @if ($user->status == 2)
                        <a class="btn btn-info mt-1" data-method="PATCH" data-token="{{ csrf_token() }}"
                            data-toggle="tooltip" data-confirm="Are you sure?"
                            href="{{ route('backend.users.unblock', $user) }}"
                            title="{{ __('labels.backend.unblock') }}"><i class="fas fa-check"></i> @lang('Unblock')</a>
                    @endif
                    <a class="btn btn-danger mt-1" data-method="DELETE" data-token="{{ csrf_token() }}"
                        data-toggle="tooltip" data-confirm="Are you sure?"
                        href="{{ route('backend.users.destroy', $user) }}" title="{{ __('labels.backend.delete') }}"><i
                            class="fas fa-trash-alt"></i> @lang('Delete')</a>
                    @if ($user->email_verified_at == null)
                        <a class="btn btn-primary mt-1" data-toggle="tooltip"
                            href="{{ route('backend.users.emailConfirmationResend', $user->id) }}"
                            title="Send Confirmation Email"><i class="fas fa-envelope"></i> @lang('Email Confirmation')</a>
                    @endif
                </div>
            </div>
        </div>
    </x-backend.layouts.show>
    <div class="card">
        <div class="card-body">
            <div class="container">
            <h4>Address <x-buttons.create route='{{ route("backend.addresses.create",["user_id"=>$user->id]) }}' title="{{__('Create')}} {{ ucwords(Str::singular('Address')) }}" /></h4>
            
            <!-- DataTable -->
            <table id="useHistoryTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Address Line 1</th>
                        <th>Address Line 2</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip Code</th>
                        <th>Country</th>
                        <th>Address Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($$module_name_singular->addresses)
                    @foreach($$module_name_singular->addresses as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->AddressLine1 }}</td>
                            <td>{{ $item->AddressLine2 }}</td>
                            <td>{{ $item->City }}</td>
                            <td>{{ $item->State }}</td>
                            <td>{{ $item->ZipCode }}</td>
                            <td>{{ $item->Country }}</td>
                            <td>{{ $item->AddressType }}</td>
                            <td><a href="{{route('backend.addresses.edit', $item)}}" class="btn btn-primary btn-sm mt-1" data-toggle="tooltip" title="{{__('labels.backend.edit')}}"><i class="fas fa-pencil"></i></a></td>
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