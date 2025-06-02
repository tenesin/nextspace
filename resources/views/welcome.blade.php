<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
<body class="bg-gray-900 text-white font-sans antialiased min-h-screen flex items-center justify-center">

    <div class="max-w-md w-full bg-gray-800 p-12 rounded-xl shadow-2xl">

        <div class="text-center mb-12">
            <h1 class="text-5xl font-light tracking-tight mb-16">
                <span class="text-primary ">Next</span><span class="text-primary font-semibold">Space</span>
            </h1>
        </div>

        <div class="space-y-4">
            <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center border-2 border-primary text-white py-4 px-6 rounded-lg hover:bg-primary hover:bg-opacity-10 transition-all duration-200 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 text-primary" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                </svg>
                Sign up With Email
            </a>

            <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center border-2 border-primary text-white py-4 px-6 rounded-lg hover:bg-primary hover:bg-opacity-10 transition-all duration-200 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 text-primary" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6.62 10.79a15.91 15.91 0 006.59 6.59l2.2-2.2a1 1 0 011.11-.27c1.2.48 2.5.73 3.85.73a1 1 0 011 1v3.25a1 1 0 01-1 1A18 18 0 013 6a1 1 0 011-1h3.25a1 1 0 011 1c0 1.35.25 2.65.73 3.85a1 1 0 01-.27 1.11l-2.09 2.09z"/>
                </svg>
                Sign up With Phone
            </a>
        </div>

        <div class="flex items-center my-8">
            <hr class="flex-grow border-gray-600">
            <span class="px-4 text-gray-400 text-sm">or</span>
            <hr class="flex-grow border-gray-600">
        </div>

        <div class="text-center mb-8">
            <a href="#" class="text-white hover:text-primary transition-colors underline decoration-primary underline-offset-4">
                Continue as <span class="text-primary font-semibold">Guest</span>
            </a>
        </div>

        <div class="text-center text-sm text-text-secondary">
            Already a user?
            <a href="{{ route('login') }}" class="text-primary font-semibold underline hover:text-primary-light transition-colors">Sign in</a>
        </div>

        <div class="mt-16 pt-8 border-t border-primary border-opacity-30">
            <div class="flex justify-center items-end space-x-6 text-primary opacity-60">
                <svg class="w-8 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M8 21v-5h8v5"/>
                    <path d="M12 16V8"/>
                    <path d="M8 8l4-4 4 4"/>
                    <circle cx="12" cy="8" r="4"/>
                </svg>

                <svg class="w-16 h-10" viewBox="0 0 64 32" fill="currentColor">
                    <ellipse cx="32" cy="24" rx="28" ry="8"/>
                    <path d="M8 16c4-4 8-6 12-6s8 2 12 6c4-4 8-6 12-6s8 2 12 6" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>

                <svg class="w-8 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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