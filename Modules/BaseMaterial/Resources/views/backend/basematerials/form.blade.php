<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'name';
                $field_label = label_case($field_name);
                $field_placeholder = $field_label;
                $required = 'required';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'status';
            $field_label = label_case($field_name);
            $field_placeholder = "-- Select an option --";
            $required = "required";
            $select_options = trans('ingredient::text.status_array');
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'UserID';
                $field_label = label_case('Compounder');
                $field_placeholder = $field_label;
                $required = '';
               
                $compounders = \App\Models\User::role('compounder')->get();
                $select_options = $compounders->pluck('name', 'id')->prepend('-- Select Compounder --', '');
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
        </div>
    </div>
</div>



<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'QuantityProduced';
                $field_label = label_case('Quantity Produced (Kg )');
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
                $field_name = 'LocationID';
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
</div>

<div class="row">
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

@php
$ingredients = \Modules\Ingredient\Models\Ingredient::all();

$ingredientOptions = $ingredients->map(function ($ingredient) {
    return [
        'id' => $ingredient->id,
        'name' => $ingredient->name . ' (' . $ingredient->SKU . ')', // Adjust as per your actual attribute name
    ];
})->pluck('name', 'id')->toArray();
@endphp
<div class="form-group">
    <h5>Ingredients Used</h5>
    <table class="table" id="ingredients_table">
        <thead>
            <tr>
                <th>Ingredient</th>
                <th>Quantity Used</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($data->baseMaterialIngredients))
            
                @foreach ($data->baseMaterialIngredients as $ingredient)
                    <tr>
                        <td>
                            <select name="ingredient_id[]" class="form-control select2">
                                @foreach ($ingredientOptions as $id => $name)
                                    <option value="{{ $id }}" {{ $ingredient->IngredientID == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="quantity_used[]" class="form-control" value="{{ $ingredient->QuantityUsed }}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-success add-row">+</button>
                            <button type="button" class="btn btn-danger delete-row">-</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>
                        <select name="ingredient_id[]" class="form-control">
                            @foreach ($ingredientOptions as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="quantity_used[]" required class="form-control">
                    </td>
                    <td>
                        <button type="button" class="btn btn-success add-row">+</button>
                        <button type="button" class="btn btn-danger delete-row">-</button>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
<x-library.select2 />

@push('after-scripts')
<script>
    // Add new row
    $(document).on('click', '.add-row', function() {
        var newRow = '<tr>' +
            '<td><select name="ingredient_id[]" class="form-control">@foreach ($ingredientOptions as $id => $name)<option value="{{ $id }}">{{ $name }}</option>@endforeach</select></td>' +
            '<td><input type="text" name="quantity_used[]" class="form-control"></td>' +
            '<td>' +
            '<button type="button" class="btn btn-success add-row">+</button>' +
            '<button type="button" class="btn btn-danger delete-row">-</button>' +
            '</td>' +
            '</tr>';

        $('#ingredients_table tbody').append(newRow);
    });

    // Delete row
    $(document).on('click', '.delete-row', function() {
        $(this).closest('tr').remove();
    });
</script>
@endpush