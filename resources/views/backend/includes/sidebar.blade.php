<?php
$notifications = optional(auth()->user())->unreadNotifications;
$notifications_count = optional($notifications)->count();
$notifications_latest = optional($notifications)->take(5);
?>

<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand d-sm-flex justify-content-center">
            <a href="/">
                <img class="sidebar-brand-full" src="{{ asset('img/logo-with-text.jpg') }}" alt="{{ app_name() }}"
                    height="46">
                <img class="sidebar-brand-narrow" src="{{ asset('img/logo-square.jpg') }}" alt="{{ app_name() }}"
                    height="46">
            </a>
        </div>
        <button class="btn-close d-lg-none" data-coreui-dismiss="offcanvas" data-coreui-theme="dark" type="button"
            aria-label="Close"
            onclick="coreui.Sidebar.getInstance(document.querySelector(&quot;#sidebar&quot;)).toggle()"></button>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('backend.dashboard') }}">
                <i class="nav-icon fa-solid fa-cubes"></i>&nbsp;@lang('Dashboard')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('backend.notifications.index') }}">
                <i class="nav-icon fa-regular fa-bell"></i>&nbsp;@lang('Notifications')
                @if ($notifications_count)
                    &nbsp;<span class="badge badge-sm bg-info ms-auto">{{ $notifications_count }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('backend.activity-log.index') }}">
                <i class="nav-icon fa-a"></i>Activity Logs
            </a>
        </li>
        @php
            $module_name = 'ingredients';
            $text = __('Ingredients');
            $icon = 'fa-regular fa-i';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />
        @php
            $module_name = 'basematerials';
            $text = __('Base Materials');
            $icon = 'fa-regular fa-b';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />
        @php
            $module_name = 'orders';
            $text = __('Orders');
            $icon = 'fa-regular fa-o';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = 'ordersheets';
            $text = __('Order Sheets');
            $icon = 'fa-regular fa-o';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = 'products';
            $text = __('Products');
            $icon = 'fa-regular fa-p';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />
        @php
            $module_name = 'locations';
            $text = __('Locations');
            $icon = 'fa-regular fa-l';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />
        @php
            $module_name = 'transactions';
            $text = __('Transactions');
            $icon = 'fa-regular fa-t';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = 'suppliers';
            $text = __('Suppliers');
            $icon = 'fa-solid fa-s';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = 'users';
            $text = __('Employees');
            $icon = 'fa-solid fa-e';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index', ['role' => 'employee']);
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = 'users';
            $text = __('Customers');
            $icon = 'fa-solid fa-c';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index', ['role' => 'customer']);
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />


        @php
            $module_name = 'settings';
            $text = __('Settings');
            $icon = 'fa-solid fa-gears';
            $permission = 'edit_' . $module_name;
            $url = route('backend.' . $module_name);
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = 'backups';
            $text = __('Backups');
            $icon = 'fa-solid fa-box-archive';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = 'users';
            $text = __('Users');
            $icon = 'fa-solid fa-user-group';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        @unless(auth()->user()->hasRole('manager'))
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />
        @endunless

        @php
            $module_name = 'roles';
            $text = __('Roles');
            $icon = 'fa-solid fa-user-shield';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @can('view_logs')
            <li class="nav-group" aria-expanded="true">
                <a class="nav-link nav-group-toggle" href="#">
                    <i class="nav-icon fa-solid fa-list-ul"></i>&nbsp;@lang('Logs')
                </a>
                <ul class="nav-group-items compact" style="height: auto;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('log-viewer::dashboard') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Log Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('log-viewer::logs.list') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Daily Log
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

    </ul>
    <div class="sidebar-footer border-top d-none d-md-flex">
        <button class="sidebar-toggler" data-coreui-toggle="unfoldable" type="button"></button>
    </div>
</div>
