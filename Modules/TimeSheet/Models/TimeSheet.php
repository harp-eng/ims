<?php

namespace Modules\TimeSheet\Models;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeSheet extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'timesheets';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\TimeSheet\database\factories\TimeSheetFactory::new();
    }

    /**
     * Get the user that created the base material.
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
