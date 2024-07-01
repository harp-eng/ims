<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'IngredientID';
                $field_label = label_case('Ingredient');
                $field_placeholder = '-- Select an option --'; // Adjust placeholder as needed
                $required = 'required';
                $ingredients = \Modules\Ingredient\Models\Ingredient::all();
                $select_options = $ingredients->pluck('name', 'id')->toArray();
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'SupplierID';
                $field_label = label_case('Supplier');
                $field_placeholder = '-- Select an option --'; // Adjust placeholder as needed
                $required = 'required';
                $suppliers = \Modules\Supplier\Models\Supplier::all();
                $select_options = $suppliers->pluck('name', 'id')->toArray();
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'status';
                $field_label = label_case($field_name);
                $field_placeholder = '-- Select an option --';
                $required = 'required';
                $select_options = [
                    '1' => 'Published',
                    '0' => 'Unpublished',
                    '2' => 'Draft',
                ];
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
                $field_name = 'ExpiryDate';
                $field_label = label_case('Expiry Date');
                $field_placeholder = $field_label;
                $required = 'required';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'PurchaseDate';
                $field_label = label_case('Purchase Date');
                $field_placeholder = $field_label;
                $required = 'required';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'QuantityPurchased';
                $field_label = label_case('Quantity Purchased');
                $field_placeholder = $field_label;
                $required = 'required';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'LocationID';
                $field_label = label_case('Location');
                $field_placeholder = '-- Select an option --'; // Adjust placeholder as needed
                $required = 'required';
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
                $field_name = 'UnitPrice';
                $field_label = label_case('Unit Price');
                $field_placeholder = $field_label;
                $required = 'required';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
            @php
                $field_name = 'TotalPrice';
                $field_label = label_case('Total Price');
                $field_placeholder = $field_label;
            @endphp
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$field_name", 'hidden']) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'DeliveryDate';
                $field_label = label_case('Delivery Date');
                $field_placeholder = $field_label;
                $required = 'required';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 mb-3">
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
</div>
<div class="row">
    <div class="col-12 mb-3">
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
@push('after-scripts')
    <script>
        // Function to update total price based on unit price and quantity purchased
        function updateTotalPrice() {
            var unitPrice = parseFloat(document.getElementById('UnitPrice').value) || 0;
            var quantity = parseFloat(document.getElementById('QuantityPurchased').value) || 0;
            var totalPrice = unitPrice * quantity;
            document.getElementById('TotalPrice').value = totalPrice.toFixed(
                2); // Display as decimal (e.g., 2 decimal places)
                console.log(document.getElementById('TotalPrice').value);
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('UnitPrice').addEventListener('input', updateTotalPrice);
            document.getElementById('QuantityPurchased').addEventListener('input', updateTotalPrice);

            // Initial update when page loads
            updateTotalPrice();
        });
        updateTotalPrice();
    </script>
@endpush
<x-library.select2 />


