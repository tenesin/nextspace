<x-guest-layout>
    <div class="max-w-4xl mx-auto bg-gray-800 text-white p-12 mb-20">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-light mb-4">
                <span class="text-primary">Next</span><span class="font-semibold text-primary">Space</span>
            </h1>
            <h2 class="text-2xl font-medium">Let's get you started</h2>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-primary mb-2">Email address</label>
                <x-text-input id="email" class="w-full py-4 px-6 bg-gray-700 border border-gray-600 rounded-lg text-white" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="bobsmith@gmail.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-error text-sm" />
            </div>

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-primary mb-2">Full name</label>
                <x-text-input id="name" class="w-full py-4 px-6 bg-gray-700 border border-gray-600 rounded-lg text-white" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Bob Smith" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-error text-sm" />
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-primary mb-2">Password</label>
                <x-text-input id="password" class="w-full py-4 px-6 bg-gray-700 border border-gray-600 rounded-lg text-white" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-error text-sm" />
            </div>

            <div class="mb-8">
                <label for="password_confirmation" class="block text-sm font-medium text-primary mb-2">Confirm Password</label>
                <x-text-input id="password_confirmation" class="w-full py-4 px-6 bg-gray-700 border border-gray-600 rounded-lg text-white" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-error text-sm" />
            </div>

           <x-secondary-button type="submit" class="w-full bg-primary text-text-primary font-semibold py-4 rounded-lg hover:bg-primary-dark transition duration-300 text-center">
            Sign Up
            </x-secondary-button>
        </form>

        <div class="text-center mt-6 text-sm text-text-secondary">
            Already a user?
            <a href="{{ route('login') }}" class="text-primary font-semibold underline">Sign in</a>
        </div>

        <div class="mt-12 pt-6 border-t border-primary/30">
            <div class="flex justify-center items-end gap-6 text-primary opacity-70">
                <svg class="w-8 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M8 21v-5h8v5"/><path d="M12 16V8"/><path d="M8 8l4-4 4 4"/><circle cx="12" cy="8" r="4"/>
                </svg>
                <svg class="w-16 h-10" viewBox="0 0 64 32" fill="currentColor">
                    <ellipse cx="32" cy="24" rx="28" ry="8"/>
                    <path d="M8 16c4-4 8-6 12-6s8 2 12 6c4-4 8-6 12-6s8 2 12 6" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
                <svg class="w-8 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 2v7c0 1.1.9 2 2 2h2v11"/>
                    <path d="M21 15V2"/><path d="M19 2v4"/><path d="M23 2v4"/>
                </svg>
            </div>
        </div>
    </div>
</x-guest-layout>