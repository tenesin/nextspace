<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-lg sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-text-primary mb-6 text-center">Confirm Your Booking</h2>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Summary of the NextSpace being booked --}}
            <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-gray-200">
                <img src="{{ $nextspace->image }}" alt="{{ $nextspace->title }}" class="w-24 h-24 object-cover rounded-lg">
                <div>
                    <p class="text-lg font-semibold text-text-primary">{{ $nextspace->title }}</p>
                    <p class="text-sm text-text-secondary">{{ $nextspace->address }}</p>
                    <p class="text-xl font-bold text-primary mt-2">${{ number_format($nextspace->base_price, 2) }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('payment.process') }}">                
                @csrf

                <input type="hidden" name="nextspace_id" value="{{ $nextspace_id }}">

                {{-- Date Selection --}}
                <div class="mb-4">
                    <label for="booking_date" class="block text-sm font-medium text-text-primary mb-2">Select a Date</label>
                    <x-text-input id="booking_date" name="booking_date" type="date" class="w-full py-3 px-4 bg-gray-100 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-primary focus:border-primary" :value="old('booking_date')" required />
                    @error('booking_date')
                        <p class="mt-2 text-error text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Time Slot Selection --}}
                <div class="mb-6">
                    <label for="time_slot" class="block text-sm font-medium text-text-primary mb-2">Select a Time Slot</label>
                    <select id="time_slot" name="selected_time_slot" class="w-full py-3 px-4 bg-gray-100 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-primary focus:border-primary">
                        <option value="">Choose a time for your booking</option>
                        @foreach ($nextspace->time_slots ?? [] as $slot)
                            <option value="{{ $slot }}">{{ $slot }}</option>
                        @endforeach
                    </select>
                    @error('selected_time_slot')
                        <p class="mt-2 text-error text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="card_number" class="block text-sm font-medium text-text-primary mb-2">Card Number</label>
                    <x-text-input id="card_number" class="w-full py-3 px-4 bg-gray-100 border border-gray-300 rounded-lg text-gray-800" type="text" name="card_number" required placeholder="e.g., 1234 5678 9012 3456" />
                    <p class="text-xs text-gray-500 mt-1">Enter the 16-digit number on the front of your card.</p>
                    @error('card_number')
                        <p class="mt-2 text-error text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="expiry_date" class="block text-sm font-medium text-text-primary mb-2">Expiry Date</label>
                        <x-text-input id="expiry_date" class="w-full py-3 px-4 bg-gray-100 border border-gray-300 rounded-lg text-gray-800" type="text" name="expiry_date" required placeholder="MM/YY (e.g., 12/25)" />
                        <p class="text-xs text-gray-500 mt-1">Month and year of expiry.</p>
                        @error('expiry_date')
                            <p class="mt-2 text-error text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="cvc" class="block text-sm font-medium text-text-primary mb-2">CVC/CVV</label>
                        <x-text-input id="cvc" class="w-full py-3 px-4 bg-gray-100 border border-gray-300 rounded-lg text-gray-800" type="text" name="cvc" required placeholder="e.g., 123" />
                        <p class="text-xs text-gray-500 mt-1">3 or 4 digit code on the back of your card.</p>
                        @error('cvc')
                            <p class="mt-2 text-error text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <x-primary-button type="submit" class="w-full bg-primary text-text-light font-semibold py-3 rounded-lg hover:bg-primary-dark transition duration-300 text-center">
                    Confirm Payment
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
