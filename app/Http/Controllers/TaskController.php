<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Filter করা tasks list
    public function index(Request $request)
    {
        $user = auth()->user();
        $projectIds = $user->projects()->pluck('id');

        $query = Task::whereIn('project_id', $projectIds)->with('project');

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Project filter
        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        // Due date filter
        if ($request->filled('due_date')) {
            $query->whereDate('due_date', $request->due_date);
        }

        $tasks = $query->orderBy('due_date')->paginate(15);

        // Filters এর জন্য projects list
        $projects = $user->projects()->get();

        return view('tasks.index', compact('tasks', 'projects'));
    }

    // নতুন task তৈরির form
    public function create(Request $request)
    {
        $projects = auth()->user()->projects()->get();

        // URL থেকে project_id থাকলে pre-select করবে
        $selectedProject = $request->project_id;

        return view('tasks.create', compact('projects', 'selectedProject'));
    }

    // নতুন task save
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in-progress,completed',
            'due_date' => 'required|date',
        ]);

        // Check করবে project user এর কিনা
        $project = Project::findOrFail($validated['project_id']);
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        Task::create($validated);

        // Redirect back to project or tasks list
        if ($request->has('redirect_to_project')) {
            return redirect()->route('projects.show', $project)
                ->with('success', 'Task created successfully!');
        }

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully!');
    }

    // Task edit form
    public function edit(Task $task)
    {
        // Authorization check
        if ($task->project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $projects = auth()->user()->projects()->get();

        return view('tasks.edit', compact('task', 'projects'));
    }

    // Task update
    public function update(Request $request, Task $task)
    {
        if ($task->project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in-progress,completed',
            'due_date' => 'required|date',
        ]);

        // New project ও user এর কিনা check
        $project = Project::findOrFail($validated['project_id']);
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->update($validated);

        return redirect()->route('projects.show', $task->project)
            ->with('success', 'Task updated successfully!');
    }

    // Task delete
    public function destroy(Task $task)
    {
        if ($task->project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $projectId = $task->project_id;
        $task->delete();

        return redirect()->route('projects.show', $projectId)
            ->with('success', 'Task deleted successfully!');
    }

    // AJAX: Task status update (Bonus feature)
    public function updateStatus(Request $request, Task $task)
    {
        if ($task->project->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,in-progress,completed',
        ]);

        $task->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Task status updated!',
            'task' => $task
        ]);
    }
}