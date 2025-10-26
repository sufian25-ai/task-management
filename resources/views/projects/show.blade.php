<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $project->name }}
                </h2>
                @if($project->description)
                    <p class="text-sm text-gray-600 mt-1">{{ $project->description }}</p>
                @endif
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Task
                </a>
                <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    Edit Project
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Project Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-sm text-gray-500">Total Tasks</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $project->tasks->count() }}</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-sm text-gray-500">Pending</div>
                    <div class="text-2xl font-bold text-yellow-600">{{ $project->tasks->where('status', 'pending')->count() }}</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-sm text-gray-500">In Progress</div>
                    <div class="text-2xl font-bold text-blue-600">{{ $project->tasks->where('status', 'in-progress')->count() }}</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-sm text-gray-500">Completed</div>
                    <div class="text-2xl font-bold text-green-600">{{$project->tasks->where('status', 'completed')->count() }}</div>
</div>
</div>
<!-- Tasks List -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Tasks</h3>

                @if($project->tasks->count() > 0)
                    <div class="space-y-4">
                        @foreach($project->tasks->sortBy('due_date') as $task)
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition task-item" data-task-id="{{ $task->id }}">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3">
                                            <h4 class="text-lg font-medium text-gray-900">{{ $task->title }}</h4>
                                            
                                            <!-- Status Badge with AJAX update -->
                                            <select class="status-select text-xs rounded-full px-3 py-1 border-0 cursor-pointer
                                                @if($task->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($task->status === 'in-progress') bg-blue-100 text-blue-800
                                                @else bg-green-100 text-green-800
                                                @endif" 
                                                data-task-id="{{ $task->id }}">
                                                <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="in-progress" {{ $task->status === 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </div>

                                        @if($task->description)
                                            <p class="text-sm text-gray-600 mt-2">{{ $task->description }}</p>
                                        @endif

                                        <div class="flex items-center space-x-4 mt-3 text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                Due: {{ $task->due_date->format('M d, Y') }}
                                                
                                                @if($task->isOverdue())
                                                    <span class="ml-2 text-red-600 font-semibold">(Overdue)</span>
                                                @elseif($task->due_date->isToday())
                                                    <span class="ml-2 text-orange-600 font-semibold">(Today)</span>
                                                @elseif($task->due_date->isTomorrow())
                                                    <span class="ml-2 text-blue-600 font-semibold">(Tomorrow)</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex space-x-2 ml-4">
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No tasks</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new task for this project.</p>
                        <div class="mt-6">
                            <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                New Task
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    // AJAX Status Update (Bonus Feature)
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelects = document.querySelectorAll('.status-select');
        
        statusSelects.forEach(select => {
            select.addEventListener('change', function() {
                const taskId = this.dataset.taskId;
                const newStatus = this.value;
                const taskItem = this.closest('.task-item');
                
                // Update UI immediately
                this.className = this.className.replace(/bg-\w+-100 text-\w+-800/g, '');
                if (newStatus === 'pending') {
                    this.classList.add('bg-yellow-100', 'text-yellow-800');
                } else if (newStatus === 'in-progress') {
                    this.classList.add('bg-blue-100', 'text-blue-800');
                } else {
                    this.classList.add('bg-green-100', 'text-green-800');
                }
                
                // Send AJAX request
                fetch(`/tasks/${taskId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        const message = document.createElement('div');
                        message.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                        message.textContent = 'Task status updated!';
                        document.body.appendChild(message);
                        
                        setTimeout(() => {
                            message.remove();
                            // Reload page to update statistics
                            location.reload();
                        }, 1500);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to update task status. Please try again.');
                    location.reload();
                });
            });
        });
    });
</script>
@endpush
</x-app-layout>