<nav x-data="{ open: false }" class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 group">
                        <div class="bg-white/20 backdrop-blur-sm p-2 rounded-lg group-hover:bg-white/30 transition duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white hidden md:block">TaskMaster</span>
                    </a>
                </div>

                <!-- Navigation Links -->
<div class="hidden space-x-2 sm:-my-px sm:ml-10 sm:flex">
    <!-- Dashboard -->
    <a href="{{ route('dashboard') }}" 
       class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300
              {{ request()->routeIs('dashboard') 
                  ? 'bg-white/20 backdrop-blur-sm text-white shadow-lg' 
                  : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        Dashboard
    </a>
    
    <!-- Projects -->
    <a href="{{ route('projects.index') }}" 
       class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300
              {{ request()->routeIs('projects.*') 
                  ? 'bg-white/20 backdrop-blur-sm text-white shadow-lg' 
                  : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
        </svg>
        Projects
        @php
            $projectCount = auth()->user()->projects()->count();
        @endphp
        @if($projectCount > 0)
            <span class="ml-2 px-2 py-0.5 text-xs font-semibold bg-white/30 rounded-full">{{ $projectCount }}</span>
        @endif
    </a>
    
    <!-- Tasks -->
    <a href="{{ route('tasks.index') }}" 
       class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300
              {{ request()->routeIs('tasks.*') 
                  ? 'bg-white/20 backdrop-blur-sm text-white shadow-lg' 
                  : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
        </svg>
        Tasks
        @php
            $projectIds = auth()->user()->projects()->pluck('id');
            $pendingTasks = \App\Models\Task::whereIn('project_id', $projectIds)->where('status', 'pending')->count();
        @endphp
        @if($pendingTasks > 0)
            <span class="ml-2 px-2 py-0.5 text-xs font-semibold bg-yellow-400 text-gray-900 rounded-full animate-pulse">{{ $pendingTasks }}</span>
        @endif
    </a>

    <!-- Admin Panel (শুধু admin দেখবে) -->
    @if(auth()->user()->isAdmin())
        <a href="{{ route('admin.dashboard') }}" 
           class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300
                  {{ request()->routeIs('admin.*') 
                      ? 'bg-red-500/30 backdrop-blur-sm text-white shadow-lg ring-2 ring-red-300' 
                      : 'text-white/80 hover:bg-red-500/20 hover:text-white' }}">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            Admin Panel
            <span class="ml-2 px-2 py-0.5 text-xs font-bold bg-red-500 rounded-full">🔐</span>
        </a>
    @endif
</div>

            <!-- Right Side: Quick Actions & User -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <!-- Quick Add Dropdown -->
                <div class="relative" x-data="{ quickAdd: false }">
                    <button @click="quickAdd = !quickAdd" 
                            @click.away="quickAdd = false"
                            class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm text-white rounded-lg hover:bg-white/30 transition duration-300 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Quick Add
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="quickAdd" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 rounded-lg shadow-xl bg-white ring-1 ring-black ring-opacity-5 overflow-hidden z-50"
                         style="display: none;">
                        <div class="py-1">
                            <a href="{{ route('projects.create') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition">
                                <svg class="w-5 h-5 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                </svg>
                                <div>
                                    <div class="font-medium">New Project</div>
                                    <div class="text-xs text-gray-500">Create a project</div>
                                </div>
                            </a>
                            <a href="{{ route('tasks.create') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition">
                                <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                                <div>
                                    <div class="font-medium">New Task</div>
                                    <div class="text-xs text-gray-500">Create a task</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ userMenu: false }">
                    <button @click="userMenu = !userMenu" 
                            @click.away="userMenu = false"
                            class="flex items-center space-x-3 px-3 py-2 bg-white/20 backdrop-blur-sm rounded-lg hover:bg-white/30 transition duration-300">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="hidden md:block text-left">
                                <div class="text-sm font-medium text-white">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-white/70">{{ Str::limit(Auth::user()->email, 20) }}</div>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- User Dropdown Menu -->
                    <div x-show="userMenu" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 rounded-lg shadow-xl bg-white ring-1 ring-black ring-opacity-5 overflow-hidden z-50"
                         style="display: none;">
                        <div class="px-4 py-3 bg-gradient-to-r from-indigo-50 to-purple-50">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white/20 transition duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
<div :class="{'block': open, 'hidden': !open}" class="sm:hidden bg-white/10 backdrop-blur-lg">
    <div class="pt-2 pb-3 space-y-1 px-4">
        <!-- Dashboard Mobile -->
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-3 py-2 rounded-lg text-base font-medium transition-all duration-300
                  {{ request()->routeIs('dashboard') 
                      ? 'bg-white/20 text-white shadow-lg' 
                      : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Dashboard
        </a>
        
        <!-- Projects Mobile -->
        <a href="{{ route('projects.index') }}" 
           class="flex items-center justify-between px-3 py-2 rounded-lg text-base font-medium transition-all duration-300
                  {{ request()->routeIs('projects.*') 
                      ? 'bg-white/20 text-white shadow-lg' 
                      : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                </svg>
                Projects
            </div>
            @php
                $projectCount = auth()->user()->projects()->count();
            @endphp
            @if($projectCount > 0)
                <span class="px-2 py-0.5 text-xs font-semibold bg-white/30 rounded-full">{{ $projectCount }}</span>
            @endif
        </a>
        
        <!-- Tasks Mobile -->
        <a href="{{ route('tasks.index') }}" 
           class="flex items-center justify-between px-3 py-2 rounded-lg text-base font-medium transition-all duration-300
                  {{ request()->routeIs('tasks.*') 
                      ? 'bg-white/20 text-white shadow-lg' 
                      : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                Tasks
            </div>
            @php
                $projectIds = auth()->user()->projects()->pluck('id');
                $pendingTasks = \App\Models\Task::whereIn('project_id', $projectIds)->where('status', 'pending')->count();
            @endphp
            @if($pendingTasks > 0)
                <span class="px-2 py-0.5 text-xs font-semibold bg-yellow-400 text-gray-900 rounded-full">{{ $pendingTasks }}</span>
            @endif
        </a>

        <!-- Admin Panel Mobile (শুধু admin দেখবে) -->
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center justify-between px-3 py-2 rounded-lg text-base font-medium transition-all duration-300
                      {{ request()->routeIs('admin.*') 
                          ? 'bg-red-500/30 text-white shadow-lg ring-2 ring-red-300'
: 'text-white/80 hover:bg-red-500/20 hover:text-white' }}">
<div class="flex items-center">
<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
</svg>
Admin Panel
</div>
<span class="px-2 py-0.5 text-xs font-bold bg-red-500 rounded-full">🔐</span>
</a>
@endif
</div>
</nav>