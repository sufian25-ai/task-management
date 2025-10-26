<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    // Relationship: Task কোন Project এর
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Scope: শুধু pending tasks filter করার জন্য
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope: শুধু in-progress tasks
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in-progress');
    }

    // Scope: শুধু completed tasks
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Scope: আজকের due tasks
    public function scopeDueToday($query)
    {
        return $query->whereDate('due_date', Carbon::today());
    }

    // Helper: task overdue কিনা check
    public function isOverdue()
    {
        return $this->status !== 'completed' && $this->due_date->isPast();
    }
}