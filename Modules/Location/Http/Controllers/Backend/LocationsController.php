<?php

namespace Modules\Location\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class LocationsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Locations';

        // module name
        $this->module_name = 'locations';

        // directory path of the module
        $this->module_path = 'location::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Location\Models\Location";
    }

}
