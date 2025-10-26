<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin Dashboard
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalProjects = Project::count();
        $totalTasks = Task::count();
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();

        // Recent activities
        $recentProjects = Project::with('user')->latest()->take(10)->get();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProjects',
            'totalTasks',
            'adminCount',
            'userCount',
            'recentProjects',
            'recentUsers'
        ));
    }

    // All Users List
    public function users()
    {
        $users = User::withCount('projects')->latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    // All Projects List (সব users এর)
    public function projects()
    {
        $projects = Project::with('user')
            ->withCount('tasks')
            ->latest()
            ->paginate(20);
        
        return view('admin.projects', compact('projects'));
    }

    // All Tasks List (সব users এর)
    public function tasks()
    {
        $tasks = Task::with(['project', 'project.user'])
            ->latest()
            ->paginate(20);
        
        return view('admin.tasks', compact('tasks'));
    }

    // Delete any project (admin power)
    public function deleteProject(Project $project)
    {
        $projectName = $project->name;
        $project->delete(); // Cascade delete tasks too

        return redirect()->route('admin.projects')
            ->with('success', "Project '{$projectName}' deleted successfully!");
    }

    // Change User Role (admin ↔ user)
    public function changeRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        // Prevent self demotion (নিজেকে user বানানো যাবে না)
        if ($user->id === auth()->id() && $validated['role'] === 'user') {
            return back()->with('error', 'You cannot demote yourself!');
        }

        $user->update(['role' => $validated['role']]);

        return back()->with('success', "User role updated to {$validated['role']}!");
    }
}