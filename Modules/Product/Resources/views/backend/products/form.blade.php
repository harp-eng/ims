<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'name';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'status';
            $field_lable = label_case($field_name);
            $field_placeholder = "-- Select an option --";
            $required = "required";
            $select_options = [
                '1'=>'Published',
                '0'=>'Unpublished',
                '2'=>'Draft'
            ];
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'QuantityInStock';
                $field_label = label_case('Quantity In Stock');
                $field_placeholder = $field_label;
                $required = '';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->number($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'Unit';
            $field_lable = label_case('Container');
            $field_placeholder = "-- Select an option --";
            $required = "required";
            $select_options = [
                'Bottles'=>'Bottles',
                'Pots'=>'Pots',
            ];
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'UnitPrice';
                $field_label = label_case('UnitPrice');
                $field_placeholder = $field_label;
                $required = '';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->number($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'StorageLocation';
                $field_label = label_case('Location');
                $field_placeholder = $field_label;
                $required = '';
                $locations = \Modules\Location\Models\Location::all();
                $select_options = $locations->pluck('name', 'id')->toArray();
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
        </div>
    </div>

    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'ExpiryDate';
                $field_label = label_case($field_name);
                $field_placeholder = $field_label;
                $required = '';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'IsPerishable';
                $field_label = label_case($field_name);
                $field_placeholder = $field_label;
                $required = '';
                $select_options = [
                    'yes' => 'Yes',
                    'no' => 'No',
                ];
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'IsHazardous';
                $field_label = label_case($field_name);
                $field_placeholder = $field_label;
                $required = '';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'IsQualityCheck';
                $field_label = label_case($field_name);
                $field_placeholder = $field_label;
                $required = '';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-6 mb-3">
        <div class="form-group">
            @php
                $field_name = 'Notes';
                $field_label = label_case($field_name);
                $field_placeholder = $field_label;
                $required = '';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-6 mb-3">
        <div class="form-group">
            @php
                $field_name = 'description';
                $field_label = label_case($field_name);
                $field_placeholder = $field_label;
                $required = '';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>

</div>

<x-library.select2 />
