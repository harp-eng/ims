<?php

namespace Modules\BaseMaterial\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class BaseMaterialsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'BaseMaterials';

        // module name
        $this->module_name = 'basematerials';

        // directory path of the module
        $this->module_path = 'basematerial::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\BaseMaterial\Models\BaseMaterial";
    }

}
