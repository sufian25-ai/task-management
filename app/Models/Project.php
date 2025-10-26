<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    // Relationship: একটা Project এর অনেক Tasks থাকতে পারে
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Relationship: Project টা কোন User এর
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper method: সব completed tasks count
    public function completedTasksCount()
    {
        return $this->tasks()->where('status', 'completed')->count();
    }

    // Helper method: সব pending tasks count
    public function pendingTasksCount()
    {
        return $this->tasks()->where('status', 'pending')->count();
    }
}