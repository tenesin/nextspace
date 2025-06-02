<header class="bg-white p-4 border-b border-gray-200 shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center h-16">
        {{-- Left side: Welcome Message --}}
        <div class="text-xl font-bold text-text-primary">Welcome to <span class="text-primary"> NextSpace </span></div>

        {{-- Right side: Navigation Links and User Info --}}
        <nav class="flex items-center space-x-6">
            {{-- Navigation Links (now light background appropriate) --}}
            <a href="#" class="text-text-secondary hover:text-primary transition-colors font-medium">Home</a>
            <a href="#" class="text-text-secondary hover:text-primary transition-colors font-medium">Contact Us</a>

            {{-- Sign Out Link --}}
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-primary hover:underline transition-colors font-medium">Sign Out</a>

            {{-- User Info and Avatar --}}
            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 text-text-primary hover:text-primary transition-colors">
                <span class="font-medium">{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF&size=32&font-size=0.6" alt="User Avatar" class="rounded-full w-8 h-8">
            </a>
        </nav>

        {{-- Hidden form for logout --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</header>