<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-primary" />
            <x-text-input id="email" class="block mt-1 w-full py-4 px-6 bg-gray-700 border border-gray-600 rounded-lg text-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="your.email@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-error" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-primary" />
            <x-text-input id="password" class="block mt-1 w-full py-4 px-6 bg-gray-700 border border-gray-600 rounded-lg text-white" type="password" name="password" required autocomplete="current-password" placeholder="Your secure password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-error" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-600 text-primary shadow-sm focus:ring-primary focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-text-secondary">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-text-secondary hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-primary text-text-primary font-semibold py-2 px-4 rounded-lg hover:bg-primary-dark transition duration-300 text-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>