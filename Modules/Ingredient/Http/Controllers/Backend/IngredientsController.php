<?php

namespace Modules\Ingredient\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class IngredientsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Ingredients';

        // module name
        $this->module_name = 'ingredients';

        // directory path of the module
        $this->module_path = 'ingredient::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Ingredient\Models\Ingredient";
    }

}
