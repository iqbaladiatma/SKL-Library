<nav x-data="{ open: false }" class="bg-emerald-900 border-b border-emerald-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo Section -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <x-application-logo class="block h-9 w-auto text-white" />
                    <span class="text-2xl font-bold text-white hidden md:block">eLibrary</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden sm:flex space-x-8">
                <x-nav-link 
                    :href="route('home')" 
                    :active="request()->routeIs('home')"
                    class="text-white hover:text-emerald-300 border-b-2 border-transparent hover:border-emerald-400 transition-all"
                >
                    Home
                </x-nav-link>
                <x-nav-link 
                    :href="route('books.index')" 
                    :active="request()->routeIs('books.index')"
                    class="text-white hover:text-emerald-300 border-b-2 border-transparent hover:border-emerald-400 transition-all"
                >
                    Books
                </x-nav-link>
                <x-nav-link 
                    :href="route('about')" 
                    :active="request()->routeIs('about')"
                    class="text-white hover:text-emerald-300 border-b-2 border-transparent hover:border-emerald-400 transition-all"
                >
                    About Us
                </x-nav-link>
                <x-nav-link 
                    :href="route('contact')" 
                    :active="request()->routeIs('contact')"
                    class="text-white hover:text-emerald-300 border-b-2 border-transparent hover:border-emerald-400 transition-all"
                >
                    Contact Us
                </x-nav-link>
                @auth
                <x-nav-link 
                    :href="route('dashboard')" 
                    :active="request()->routeIs('dashboard')"
                    class="text-white hover:text-emerald-300 border-b-2 border-transparent hover:border-emerald-400 transition-all"
                >
                    Dashboard
                </x-nav-link>
                @endauth
                @auth
                @if (auth()->user()->hasRole('admin'))
                <a href="/admin" class="flex items-center px-3 py-2 text-sm font-medium text-red-400 hover:text-red-300 transition-colors">
                    Admin Panel
                </a>
                @endif
                @endauth
            </div>

            <!-- Auth Section -->
            <div class="hidden sm:flex items-center space-x-6">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-2 px-4 py-2 border border-emerald-400 rounded-full bg-emerald-500/10 hover:bg-emerald-500/20 transition-colors">
                            <span class="text-emerald-100">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-emerald-300" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-emerald-700 hover:bg-emerald-50">
                            Profile
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link 
                                :href="route('logout')"
                                class="text-gray-700 hover:bg-gray-50"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-emerald-300 hover:text-white px-4 py-2 rounded-full border border-emerald-400/30 transition-colors">
                        Login
                    </a>
                    @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-emerald-500 text-white px-6 py-2 rounded-full hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-500/30">
                        Register
                    </a>
                    @endif
                </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex sm:hidden">
                <button @click="open = ! open" class="p-2 text-emerald-300 hover:text-white hover:bg-emerald-500/10 rounded-lg transition-colors">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                        <path :class="{ 'hidden': open }" class="inline-flex" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open }" class="hidden" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden bg-emerald-800/95 backdrop-blur-lg">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white hover:text-emerald-300">
                Home
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('books.index')" :active="request()->routeIs('books.index')" class="text-white hover:text-emerald-300">
                Books
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-white hover:text-emerald-300">
                About Us
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="text-white hover:text-emerald-300">
                Contact Us
            </x-responsive-nav-link>
            @auth
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-emerald-300">
                Dashboard
            </x-responsive-nav-link>
            @endauth
            @auth
            @if (auth()->user()->hasRole('admin'))
            <x-responsive-nav-link href="/admin" class="text-red-400 hover:text-red-300">
                Admin Panel
            </x-responsive-nav-link>
            @endif
            @endauth
        </div>

        <!-- Mobile Auth Links -->
        <div class="pt-4 pb-2 border-t border-emerald-700">
            @auth
            <div class="px-4">
                <div class="font-medium text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-emerald-300">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-emerald-300 hover:text-white">
                    Profile
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link 
                        :href="route('logout')"
                        class="text-emerald-300 hover:text-white"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
            @else
            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('login') }}" class="block text-emerald-300 hover:text-white px-4 py-2">
                    Login
                </a>
                @if(Route::has('register'))
                <a href="{{ route('register') }}" class="block bg-emerald-500 text-white px-4 py-2 rounded-full">
                    Register
                </a>
                @endif
            </div>
            @endauth
        </div>
    </div>
</nav>