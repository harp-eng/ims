<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkerPerformance extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'worker_performances';

    protected $fillable = [
        'worker_id',
        'task_name',
        'task_time_taken',
        'quality_of_work',
        'quantity',
    ];

    /**
     * Get the worker that owns the performance record.
     */
    public function worker()
    {
        return $this->belongsTo(User::class);
    }
}
