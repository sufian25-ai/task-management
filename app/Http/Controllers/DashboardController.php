<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // User এর সব projects এর tasks
        $projectIds = $user->projects()->pluck('id');
        
        // Dashboard statistics
        $totalTasks = Task::whereIn('project_id', $projectIds)->count();
        $completedTasks = Task::whereIn('project_id', $projectIds)
            ->where('status', 'completed')
            ->count();
        $dueTodayTasks = Task::whereIn('project_id', $projectIds)
            ->whereDate('due_date', Carbon::today())
            ->where('status', '!=', 'completed')
            ->count();

        // Recent projects with task counts
        $recentProjects = $user->projects()
            ->withCount('tasks')
            ->latest()
            ->take(5)
            ->get();

        // Upcoming tasks (next 7 days)
        $upcomingTasks = Task::whereIn('project_id', $projectIds)
            ->where('status', '!=', 'completed')
            ->whereBetween('due_date', [Carbon::today(), Carbon::today()->addDays(7)])
            ->orderBy('due_date')
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalTasks',
            'completedTasks',
            'dueTodayTasks',
            'recentProjects',
            'upcomingTasks'
        ));
    }
}