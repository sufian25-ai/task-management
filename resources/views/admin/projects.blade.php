<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                📁 All Projects
            </h2>
            <span class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full">ADMIN</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">All Projects ({{ $projects->total() }})</h3>
                    </div>

                    @if($projects->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($projects as $project)
                                <div class="border rounded-lg p-5 hover:shadow-lg transition">
                                    <!-- Project Header -->
                                    <div class="flex justify-between items-start mb-4">
                                        <h4 class="text-lg font-semibold text-gray-900">{{ $project->name }}</h4>
                                        <form action="{{ route('admin.projects.delete', $project) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure? This will delete all tasks too!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Description -->
                                    @if($project->description)
                                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $project->description }}</p>
                                    @endif

                                    <!-- Owner Info -->
                                    <div class="flex items-center space-x-2 mb-4 pb-4 border-b">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white text-sm font-bold">
                                            {{ strtoupper(substr($project->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $project->user->name }}</p>
                                            <p class="text-xs text-gray-500">Owner</p>
                                        </div>
                                    </div>

                                    <!-- Stats -->
                                    <div class="grid grid-cols-2 gap-3 mb-4">
                                        <div class="bg-blue-50 p-3 rounded-lg">
                                            <p class="text-xs text-gray-600">Total Tasks</p>
                                            <p class="text-xl font-bold text-blue-600">{{ $project->tasks_count }}</p>
                                        </div>
                                        <div class="bg-green-50 p-3 rounded-lg">
                                            <p class="text-xs text-gray-600">Created</p>
                                            <p class="text-sm font-semibold text-green-600">{{ $project->created_at->format('M d') }}</p>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <a href="{{ route('projects.show', $project) }}" 
                                       class="block w-full text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                        View Details
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $projects->links() }}
                        </div>

                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No projects</h3>
                            <p class="mt-1 text-sm text-gray-500">No projects have been created yet.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>