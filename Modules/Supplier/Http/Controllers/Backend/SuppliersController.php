<?php

namespace Modules\Supplier\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class SuppliersController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Suppliers';

        // module name
        $this->module_name = 'suppliers';

        // directory path of the module
        $this->module_path = 'supplier::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Supplier\Models\Supplier";
    }

}
