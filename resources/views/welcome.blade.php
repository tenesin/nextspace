<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#3b82f6',
                        'primary-dark': '#2563eb',
                        'primary-light': '#60a5fa'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white font-sans antialiased min-h-screen flex items-center justify-center">

    <div class="max-w-md w-full bg-gray-800/50 backdrop-blur-sm p-12 rounded-2xl shadow-2xl border border-gray-700">

        <div class="text-center mb-12">
            <div class="mx-auto h-16 w-16 bg-blue-600 rounded-full flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h1 class="text-5xl font-light tracking-tight mb-4">
                <span class="text-blue-400">Next</span><span class="text-white font-semibold">Space</span>
            </h1>
            <p class="text-gray-300 text-lg">Welcome to the future of collaboration</p>
        </div>

        <div class="space-y-4">
            <!-- Register Button -->
            <a href="{{ route('register') }}" class="w-full group relative flex items-center justify-center bg-blue-600 text-white py-4 px-6 rounded-xl hover:bg-blue-700 transition-all duration-200 font-medium transform hover:scale-[1.02] shadow-lg hover:shadow-blue-500/25">
                <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                    <svg class="w-5 h-5 text-blue-300 group-hover:text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </span>
                Create Account
            </a>

            <!-- Login Button -->
            <a href="{{ route('login') }}" class="w-full group relative flex items-center justify-center border-2 border-gray-600 text-white py-4 px-6 rounded-xl hover:bg-gray-700/50 hover:border-gray-500 transition-all duration-200 font-medium transform hover:scale-[1.02]">
                <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                </span>
                Sign In
            </a>
        </div>

        <div class="mt-16 pt-8 border-t border-gray-600/30">
            <div class="flex justify-center items-center space-x-8 opacity-30">
                <svg class="w-6 h-6 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M8 21v-5h8v5"/>
                    <path d="M12 16V8"/>
                    <path d="M8 8l4-4 4 4"/>
                    <circle cx="12" cy="8" r="4"/>
                </svg>

                <svg class="w-8 h-6 text-blue-400" viewBox="0 0 64 32" fill="currentColor">
                    <ellipse cx="32" cy="24" rx="28" ry="8"/>
                    <path d="M8 16c4-4 8-6 12-6s8 2 12 6c4-4 8-6 12-6s8 2 12 6" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>

                <svg class="w-6 h-6 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 2v7c0 1.1.9 2 2 2h2v11"/>
                    <path d="M21 15V2"/>
                    <path d="M19 2v4"/>
                    <path d="M23 2v4"/>
                </svg>
            </div>
        </div>
    </div>

</body>
</html>