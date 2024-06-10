<?php

namespace Modules\Area\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class AreasController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Areas';

        // module name
        $this->module_name = 'areas';

        // directory path of the module
        $this->module_path = 'area::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Area\Models\Area";
    }

}
