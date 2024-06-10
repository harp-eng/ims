<?php

namespace Modules\Area\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'areas';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Area\database\factories\AreaFactory::new();
    }
}
