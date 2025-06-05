<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl">
                
                {{-- Header Section --}}
                <div class="bg-gradient-to-r from-primary/5 to-primary/10 p-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 text-center mb-2">Confirm Your Booking</h2>
                    <p class="text-gray-600 text-center">Complete your reservation in just a few steps</p>
                </div>

                {{-- Status Messages --}}
                @if (session('status'))
                    <div class="mx-6 mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-green-800 font-medium">{{ session('status') }}</span>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mx-6 mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="text-red-800 font-medium mb-1">Please fix the following errors:</h4>
                                <ul class="text-red-700 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="p-6">
                    {{-- Space Summary Card --}}
                    <div class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Your Selected Space
                        </h3>
                        
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <img src="{{ $nextspace->image ?? 'https://placehold.co/120x120/E0F2F7/00B4D8?text=Space' }}" 
                                     alt="{{ $nextspace->title }}" 
                                     class="w-20 h-20 object-cover rounded-lg shadow-sm">
                                <div class="absolute -top-2 -right-2 bg-primary text-white text-xs px-2 py-1 rounded-full font-semibold">
                                    ${{ number_format($nextspace->base_price, 2) }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-900">{{ $nextspace->title }}</h4>
                                <div class="flex items-center text-gray-600 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-sm">{{ $nextspace->address }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('payment.process') }}" class="space-y-6">                
                        @csrf
                        <input type="hidden" name="nextspace_id" value="{{ $nextspace_id }}">

                        {{-- Booking Details Section --}}
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z" />
                                </svg>
                                Booking Details
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Date Selection --}}
                                <div class="space-y-2">
                                    <label for="booking_date" class="block text-sm font-semibold text-gray-700">
                                        Select Date
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <x-text-input 
                                            id="booking_date" 
                                            name="booking_date" 
                                            type="date" 
                                            class="w-full py-3 px-4 bg-white border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200" 
                                            :value="old('booking_date')" 
                                            required 
                                        />
                                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-3.5 h-5 w-5 text-gray-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z" />
                                        </svg>
                                    </div>
                                    @error('booking_date')
                                        <p class="text-red-600 text-sm flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Time Slot Selection --}}
                                <div class="space-y-2">
                                    <label for="selected_time_slot_id" class="block text-sm font-semibold text-gray-700">
                                        Time Slot
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select 
                                            id="selected_time_slot_id" 
                                            name="selected_time_slot_id" 
                                            class="w-full py-3 px-4 bg-white border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 appearance-none"
                                            required
                                        >
                                            <option value="">Choose your preferred time</option>
                                            @foreach ($availableTimeSlots as $slot)
                                                <option value="{{ $slot->id }}" {{ old('selected_time_slot_id') == $slot->id ? 'selected' : '' }}>
                                                    {{ $slot->slot }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-3.5 h-5 w-5 text-gray-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                    @error('selected_time_slot_id')
                                        <p class="text-red-600 text-sm flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Services Selection --}}
                            <div class="space-y-2">
                                <label for="selected_service_ids" class="block text-sm font-semibold text-gray-700">
                                    Additional Services
                                    <span class="text-gray-500 font-normal">(Optional)</span>
                                </label>
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    <div class="grid grid-cols-1 gap-3 max-h-40 overflow-y-auto">
                                            @php
                                            $serviceIds = $nextspace->services ?? [];
                                            $rawServiceIds = is_string($serviceIds) ? json_decode($serviceIds, true) : $serviceIds;
                                            $serviceIds = is_array($rawServiceIds) ? $rawServiceIds : [];
                                            $displayServices = \App\Models\Service::whereIn('id', $serviceIds)->get();
                                        @endphp

                            @foreach ($displayServices as $service)
                                <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-primary/30 transition-colors cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        name="selected_service_ids[]" 
                                        value="{{ $service->id }}" 
                                        class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary/20"
                                        {{ in_array($service->id, old('selected_service_ids', [])) ? 'checked' : '' }}
                                    >
                                    <div class="ml-3 flex-1">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm font-medium text-gray-900">{{ $service->name }}</span>
                                            <span class="text-sm font-semibold text-primary">${{ number_format($service->price ?? 0, 2) }}</span>
                                        </div>
                                    </div>
                                </label>
                            @endforeach

                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">Select any additional services you'd like to include with your booking.</p>
                                </div>
                                @error('selected_service_ids')
                                    <p class="text-red-600 text-sm flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                

                    {{-- Payment Information Section --}}
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                Payment Information
                            </h3>

                            <div class="space-y-4">
                                {{-- Card Number --}}
                                <div class="space-y-2">
                                    <label for="card_number" class="block text-sm font-semibold text-gray-700">
                                        Card Number
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <x-text-input 
                                            id="card_number" 
                                            class="w-full py-3 px-4 pr-12 bg-white border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200" 
                                            type="text" 
                                            name="card_number" 
                                            required 
                                            placeholder="1234 5678 9012 3456"
                                            maxlength="19"
                                        />
                                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-3.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                    </div>
                                    <p class="text-xs text-gray-500">Enter the 16-digit number on the front of your card</p>
                                    @error('card_number')
                                        <p class="text-red-600 text-sm flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    {{-- Expiry Date --}}
                                    <div class="space-y-2">
                                        <label for="expiry_date" class="block text-sm font-semibold text-gray-700">
                                            Expiry Date
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <x-text-input 
                                            id="expiry_date" 
                                            class="w-full py-3 px-4 bg-white border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200" 
                                            type="text" 
                                            name="expiry_date" 
                                            required 
                                            placeholder="MM/YY"
                                            maxlength="5"
                                        />
                                        <p class="text-xs text-gray-500">MM/YY format</p>
                                        @error('expiry_date')
                                            <p class="text-red-600 text-sm flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- CVC --}}
                                    <div class="space-y-2">
                                        <label for="cvc" class="block text-sm font-semibold text-gray-700">
                                            CVC/CVV
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <x-text-input 
                                            id="cvc" 
                                            class="w-full py-3 px-4 bg-white border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200" 
                                            type="text" 
                                            name="cvc" 
                                            required 
                                            placeholder="123"
                                            maxlength="4"
                                        />
                                        <p class="text-xs text-gray-500">3-4 digit code</p>
                                        @error('cvc')
                                            <p class="text-red-600 text-sm flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Security Notice --}}
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <div>
                                    <h4 class="text-blue-800 font-medium text-sm">Secure Payment</h4>
                                    <p class="text-blue-700 text-sm">Your payment information is encrypted and secure. We never store your card details.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="pt-4">
                            <x-primary-button 
                                type="submit" 
                                class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-4 px-6 rounded-lg transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg flex items-center justify-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Confirm Payment & Book Space
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript for form enhancements --}}
    <script>
        // Format card number input
        document.getElementById('card_number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formattedValue;
        });

        // Format expiry date input
        document.getElementById('expiry_date').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });

        // Only allow numbers for CVC
        document.getElementById('cvc').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });

        // Set minimum date to today
        document.getElementById('booking_date').min = new Date().toISOString().split('T')[0];
    </script>
</x-app-layout>