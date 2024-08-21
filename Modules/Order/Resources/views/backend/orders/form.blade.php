<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'CustomerID';
                $field_label = 'Customer ID';
                $field_placeholder = $field_label;
                $required = 'required';

                // Fetch customers with 'customer' role
                $customers = \App\Models\User::role('customer')->get();
                $select_options = $customers->pluck('name', 'id')->prepend('-- Select Customer --', '');

            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}   <x-buttons.create route='{{ route("backend.users.create",["role"=>"customer"]) }}' title="{{__('Create')}} {{ ucwords(Str::singular('Address')) }}" />
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'ShippingAddressID';
                $field_label = 'Shipping Address ID';
                $field_placeholder = $field_label;
                $required = 'required';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, [])->placeholder('-- Select Address --')->class('form-control')->attributes(["$required", 'id' => 'shipping_address']) }}
        </div>
    </div>

    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'BillingAddressID';
                $field_label = 'Billing Address ID';
                $field_placeholder = $field_label;
                $required = 'required';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, [])->placeholder('-- Select Address --')->class('form-control')->attributes(["$required", 'id' => 'billing_address']) }}

            {{ html()->hidden('TotalAmount')->attributes(['id' => 'TotalAmount']) }}
            {{ html()->hidden('OrderDate')->value(now()->toDateString()) }}
            {{ html()->hidden('ShipDate')->value(now()->toDateString()) }}
        </div>
    </div>

    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            @php
                $field_name = 'status';
                $field_label = 'Status';
                $field_placeholder = $field_label;
                $required = 'required';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, ['Pending'=>'Pending','Processing'=>'Processing','Ready To Ship'=>'Ready To Ship','Shipped'=>'Shipped','Delivered'=>'Delivered','Cancelled'=>'Cancelled'])->placeholder('-- Select Status --')->class('form-control')->attributes(["$required"]) }}

        </div>
    </div>
</div>


<div class="row">
    <div class="col-12 mb-3">
        <div class="form-group">
            @php
                $field_name = 'Notes';
                $field_label = 'Notes';
                $field_placeholder = $field_label;
                $required = '';
            @endphp
            {{ html()->label($field_label, $field_name)->class('form-label') }}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>
@php
    $products = \Modules\Product\Models\Product::all();

    $productOptions = $products
        ->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name . ' (' . $product->SKU . ')', // Assuming SKU is an attribute of the Product model
            ];
        })
        ->pluck('name', 'id')
        ->toArray();

    $unitPrices = $products
        ->map(function ($product) {
            return [
                'id' => $product->id,
                'price' => $product->UnitPrice,
            ];
        })
        ->pluck('price', 'id')
        ->toArray();

@endphp

<div class="form-group">
    <h5>Order Items</h5>
    <table class="table" id="order_details_table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @if (!empty($data))

                @foreach ($data->orderDetails as $item)
                    <tr>
                        <td>
                            <select name="ProductID[]" required class="form-control product-select">
                                <option value="">-- Select Product --</option>
                                @foreach ($productOptions as $id => $name)
                                    <option data-unit_price="{{ $unitPrices[$id] }}" value="{{ $id }}"
                                        {{ $item->ProductID == $id ? 'selected' : '' }}>{{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="Quantity[]" required class="form-control quantity"
                                value="{{ $item->Quantity }}">
                        </td>
                        <td>
                            <input type="text" name="UnitPrice[]" class="form-control unit-price"
                                value="{{ $item->UnitPrice }}">
                        </td>
                        <td>
                            <input type="text" name="TotalPrice[]" class="form-control total-price"
                                value="{{ $item->TotalPrice }}">
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
                        <select name="ProductID[]" required class="form-control product-select">
                            <option value="">-- Select Product --</option>
                            @foreach ($productOptions as $id => $name)
                                <option value="{{ $id }}" data-unit_price="{{ $unitPrices[$id] }}">
                                    {{ $name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" required name="Quantity[]" value="1" class="form-control quantity">
                    </td>
                    <td>
                        <input type="text" name="UnitPrice[]" class="form-control unit-price" value="">
                    </td>
                    <td>
                        <input type="text" name="TotalPrice[]" class="form-control total-price" value="">
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
        $(document).ready(function() {
            // Add new row
            $(document).on('click', '.add-row', function() {
                console.log('ddd');
                var newRow = '<tr>' +
                    '<td><select name="ProductID[]" required class="form-control product-select">' +
                    '<option value="">-- Select Product --</option>' +
                    '@foreach ($productOptions as $id => $name)' +
                    '<option value="{{ $id }}" data-unit_price="{{ $unitPrices[$id] }}">{{ $name }}</option>' +
                    '@endforeach' +
                    '</select></td>' +
                    '<td><input type="text" name="Quantity[]" value="1" required class="form-control quantity"></td>' +
                    '<td><input type="text" name="UnitPrice[]" class="form-control unit-price"></td>' +
                    '<td><input type="text" name="TotalPrice[]" class="form-control total-price"></td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-success add-row">+</button>' +
                    '<button type="button" class="btn btn-danger delete-row">-</button>' +
                    '</td>' +
                    '</tr>';

                $('#order_details_table tbody').append(newRow);
            });

            // Delete row
            $(document).on('click', '.delete-row', function() {
                $(this).closest('tr').remove();
            });

            // Update Unit Price on Product select change
            $(document).on('change', '.product-select', function() {
                var unitPrice = $(this).find('option:selected').data('unit_price');
                console.log(unitPrice);
                var tr = $(this).closest('tr');
                tr.find('.unit-price').val(unitPrice);
                updateTotalPrice(tr);
            });

            // Update Total Price on Quantity or Unit Price change
            $(document).on('input', '.quantity, .unit-price', function() {
                updateTotalPrice($(this).closest('tr'));
            });

            // Function to update Total Price based on Quantity and Unit Price
            function updateTotalPrice(tr) {
                var quantity = parseFloat(tr.find('.quantity').val());
                var unitPrice = parseFloat(tr.find('.unit-price').val());
                var totalPriceInput = tr.find('.total-price');
                var totalPrice = isNaN(quantity) || isNaN(unitPrice) ? 0 : (quantity * unitPrice).toFixed(2);
                totalPriceInput.val(totalPrice);
                updateOrderTotal();
            }
            // Function to update Order Total based on sum of all Total Prices
            function updateOrderTotal() {
                var orderTotal = 0;
                $('.total-price').each(function() {
                    var totalPrice = parseFloat($(this).val());
                    orderTotal += isNaN(totalPrice) ? 0 : totalPrice;
                });
                $('#TotalAmount').val(orderTotal.toFixed(2));
            }

            updateAddress();
            $('#CustomerID').on('change', function() {
                updateAddress();
            });
            function updateAddress(){
                var customerId = $('#CustomerID').val();
                if (customerId) {
                    $.ajax({
                        url: '/admin/fetch-customer-addresses/' + customerId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Clear previous options
                            $('#shipping_address').empty();
                            $('#billing_address').empty();

                            // Append new options
                            $.each(data.addresses, function(key, address) {
                                console.log(address);
                                $('body').find('#shipping_address').append($(
                                    '<option>', {
                                        value: address.id,
                                        text: address.address_line1 + ', ' +
                                            address.address_line2 + ', ' +
                                            address.city + ', ' + address
                                            .state + ', ' + address.zip_code
                                    }));
                                $('body').find('#billing_address').append($(
                                    '<option>', {
                                        value: address.id,
                                        text: address.address_line1 + ', ' +
                                            address.address_line2 + ', ' +
                                            address.city + ', ' + address
                                            .state + ', ' + address.zip_code
                                    }));
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    // Clear options if no customer selected
                    $('#shipping_address').empty().append($('<option>', {
                        value: '',
                        text: '-- Select Address --'
                    }));
                    $('#billing_address').empty().append($('<option>', {
                        value: '',
                        text: '-- Select Address --'
                    }));
                }
            }
        });
    </script>
@endpush
