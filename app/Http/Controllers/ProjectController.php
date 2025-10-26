<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // সব projects দেখাবে
    public function index()
    {
        $projects = auth()->user()
            ->projects()
            ->withCount(['tasks', 'tasks as completed_tasks_count' => function ($query) {
                $query->where('status', 'completed');
            }])
            ->latest()
            ->paginate(10);

        return view('projects.index', compact('projects'));
    }

    // নতুন project তৈরির form
    public function create()
    {
        return view('projects.create');
    }

    // নতুন project save করবে
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        Project::create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

    // একটা specific project show করবে তার tasks সহ
    public function show(Project $project)
    {
        // Authorization check: শুধু owner দেখতে পারবে
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $project->load('tasks'); // Tasks eager load

        return view('projects.show', compact('project'));
    }

    // Project edit form
    public function edit(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('projects.edit', compact('project'));
    }

    // Project update করবে
    public function update(Request $request, Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($validated);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project updated successfully!');
    }

    // Project delete করবে
    public function destroy(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $project->delete(); // Cascade delete হবে tasks ও

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}