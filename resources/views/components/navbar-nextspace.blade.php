<header class="bg-white p-4 border-b border-gray-200 shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center h-16">
        {{-- Left side: Welcome Message / Logo --}}
        <div class="flex items-center">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-text-primary flex items-center">
                <span class="text-primary">Next</span><span class="font-semibold text-text-primary">Space</span>
            </a>
        </div>

        {{-- Mobile Menu Button (Hamburger) --}}
        <div class="md:hidden flex items-center">
            <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-md p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        {{-- Right side: Desktop Navigation Links and User Info --}}
        <nav class="hidden md:flex items-center space-x-6">
            <a href="{{ route('dashboard') }}" class="text-text-secondary hover:text-primary transition-colors font-medium">Home</a>
            <a href="{{ route('history.index') }}" class="text-text-secondary hover:text-primary transition-colors font-medium">My Bookings</a>
            <a href="{{ route('favorites.index') }}" class="text-yellow-600 hover:text-yellow-500 transition-colors font-medium flex items-center">
                
                My Favorites
            </a>
            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.nextspaces.index') }}" class="text-primary hover:underline transition-colors font-medium">Admin Page</a>
                @endif
            @endauth

            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-primary hover:underline transition-colors font-medium">Sign Out</a>

            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 text-text-primary hover:text-primary transition-colors group">
                <span class="font-medium group-hover:text-primary transition-colors">{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF&size=32&font-size=0.6" alt="User Avatar" class="rounded-full w-8 h-8 border border-gray-200">
            </a>
        </nav>

        {{-- Hidden form for logout (required for POST request logout) --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    {{-- Mobile Menu Dropdown --}}
    <div id="mobile-menu" class="md:hidden bg-white shadow-lg py-2 px-4 border-t border-gray-200 hidden">
        <nav class="flex flex-col space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-text-secondary hover:bg-gray-100 hover:text-primary transition-colors">Home</a>
            <a href="{{ route('history.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-text-secondary hover:bg-gray-100 hover:text-primary transition-colors">My Bookings</a>
            <a href="{{ route('favorites.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-yellow-600 hover:bg-gray-100 hover:text-yellow-500 transition-colors  items-center">
               
                My Favorites
            </a>
            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.nextspaces.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-primary hover:bg-gray-100 hover:underline transition-colors">Admin Page</a>
                @endif
            @endauth

            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="block px-3 py-2 rounded-md text-base font-medium text-primary hover:bg-gray-100 hover:underline transition-colors">Sign Out</a>

            <a href="{{ route('profile.edit') }}" class="flex items-center px-3 py-2 rounded-md text-base font-medium text-text-primary hover:bg-gray-100 hover:text-primary transition-colors">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF&size=24&font-size=0.6" alt="User Avatar" class="rounded-full w-6 h-6 mr-2 border border-gray-200">
                <span>{{ Auth::user()->name }}'s Profile</span>
            </a>
        </nav>
        {{-- Hidden form for mobile logout --}}
        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu if window is resized to desktop size
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) { // md breakpoint
                mobileMenu.classList.add('hidden');
            }
        });
    });
</script>