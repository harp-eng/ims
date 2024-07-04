<div class="row">
    <!-- Employee ID -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'employee_id';
            $field_label = label_case($field_name);
            $field_placeholder = "-- Select Employee --";
            $required = "required";
            $employees = \App\Models\User::role('employee')->pluck('name', 'id');
            $select_options = $employees->prepend('-- Select Employee --', '');
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes([$required]) }}
        </div>
    </div>

    <!-- Sign In Time -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'sign_in_time';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->datetimeLocal($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
        </div>
    </div>

    <!-- Sign Out Time -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'sign_out_time';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->datetimeLocal($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
        </div>
    </div>
</div>

<div class="row">
    <!-- Date -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'date';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "required";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
        </div>
    </div>

    <!-- Duration -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'duration';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->time($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
        </div>
    </div>

    <!-- Notes -->
    <div class="col-12 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'notes';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
        </div>
    </div>
</div>

<x-library.select2 />
