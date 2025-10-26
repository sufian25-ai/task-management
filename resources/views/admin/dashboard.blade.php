<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🔐 Admin Dashboard
            </h2>
            <span class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full">ADMIN</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Statistics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">
                <!-- Total Users -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-lg shadow-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-80">Total Users</p>
                            <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Admins -->
                <div class="bg-gradient-to-br from-red-500 to-red-600 p-6 rounded-lg shadow-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-80">Admins</p>
                            <p class="text-3xl font-bold">{{ $adminCount }}</p>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Regular Users -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-lg shadow-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-80">Regular Users</p>
                            <p class="text-3xl font-bold">{{ $userCount }}</p>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Total Projects -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-lg shadow-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-80">Total Projects</p>
                            <p class="text-3xl font-bold">{{ $totalProjects }}</p>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Total Tasks -->
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-6 rounded-lg shadow-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-80">Total Tasks</p>
                            <p class="text-3xl font-bold">{{ $totalTasks }}</p>
                        </div>
                        <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <a href="{{ route('admin.users') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Manage Users</h3>
                            <p class="text-sm text-gray-600">View and manage all users</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.projects') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">All Projects</h3>
                            <p class="text-sm text-gray-600">View all projects</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.tasks') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="bg-yellow-100 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">All Tasks</h3>
                            <p class="text-sm text-gray-600">View all tasks</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Recent Projects -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Projects</h3>
                    <div class="space-y-3">
                        @forelse($recentProjects as $project)
                            <div class="flex justify-between items-center p-3 border rounded-lg hover:bg-gray-50">
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $project->name }}</h4>
                                    <p class="text-sm text-gray-600">by {{ $project->user->name }}</p>
                                </div>
                                <span class="text-xs text-gray-500">{{ $project->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No projects yet</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Users</h3>
                    <div class="space-y-3">
                        @forelse($recentUsers as $user)
                            <div class="flex justify-between items-center p-3 border rounded-lg hover:bg-gray-50">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $user->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                    <p class="text-xs text-gray-500 mt-1">{{ $user->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No users yet</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>