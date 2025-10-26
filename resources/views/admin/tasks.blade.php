<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ✅ All Tasks
            </h2>
            <span class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full">ADMIN</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">All Tasks ({{ $tasks->total() }})</h3>
                    </div>

                    @if($tasks->count() > 0)
                        <div class="space-y-4">
                            @foreach($tasks as $task)
                                <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <!-- Task Title & Status -->
                                            <div class="flex items-center space-x-3 mb-2">
                                                <h4 class="text-lg font-medium text-gray-900">{{ $task->title }}</h4>
                                                <span class="px-3 py-1 text-xs rounded-full 
                                                    @if($task->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($task->status === 'in-progress') bg-blue-100 text-blue-800
                                                    @else bg-green-100 text-green-800
                                                    @endif">
                                                    {{ ucfirst($task->status) }}
                                                </span>
                                            </div>

                                            <!-- Description -->
                                            @if($task->description)
                                                <p class="text-sm text-gray-600 mb-3">{{ $task->description }}</p>
                                            @endif

                                            <!-- Project & Owner Info -->
                                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                                    </svg>
                                                    <span>{{ $task->project->name }}</span>
                                                </div>

                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                    <span>{{ $task->project->user->name }}</span>
                                                </div>

                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <span>Due: {{ $task->due_date->format('M d, Y') }}</span>
                                                    @if($task->isOverdue())
                                                        <span class="ml-2 text-red-600 font-semibold">(Overdue)</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Button -->
                                        <a href="{{ route('projects.show', $task->project) }}" 
                                           class="ml-4 px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition">
                                            View Project
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $tasks->links() }}
                        </div>

                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No tasks</h3>
                            <p class="mt-1 text-sm text-gray-500">No tasks have been created yet.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>