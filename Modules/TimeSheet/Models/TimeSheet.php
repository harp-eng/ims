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

    // Mutator to automatically update 'duration' when 'sign_out_time' is set
    public function setSignOutTimeAttribute($value)
    {
        $this->attributes['sign_out_time'] = $value;
        $this->calculateDuration();
    }

    // Calculate duration based on 'sign_in_time' and 'sign_out_time'
    private function calculateDuration()
    {
        if ($this->sign_in_time && $this->sign_out_time) {
            $signIn = new \DateTime($this->sign_in_time);
            $signOut = new \DateTime($this->sign_out_time);
            $diff = $signIn->diff($signOut);
            $duration = sprintf('%02d:%02d:%02d', $diff->h, $diff->i, $diff->s);
            $this->attributes['duration'] = $duration;
        }
    }
}
