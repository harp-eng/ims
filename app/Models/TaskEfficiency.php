<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskEfficiency extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'task_name',
        'efficiency_score',
    ];

    /**
     * Get the user that owns the task efficiency.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
