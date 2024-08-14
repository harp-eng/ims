<div class="row">
    <?php
    $fields = [
        'ContactName' => 'Contact Name',
        'ContactEmail' => 'Contact Email',
        'ContactPhone' => 'Contact Phone',
        'Address' => 'Address',
        'City' => 'City',
        'State' => 'State',
        'ZipCode' => 'Zip Code'
    ];
    foreach ($fields as $field_name => $field_lable) {
        $field_placeholder = $field_lable;
        $required = ($field_name === 'ContactName' || $field_name === 'ContactEmail' || $field_name === 'ContactPhone') ? "required" : "";
        ?>
        <div class="col-12 col-sm-4 mb-3">
            <div class="form-group">
                {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
                {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
            </div>
        </div>
    <?php } ?>
</div>
