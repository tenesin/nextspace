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
                    </ul> {{-- CORRECTED: This </ul> was inside the @foreach loop --}}
                </div>
            @endif

            {{-- Summary of the NextSpace being booked --}}
            <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-gray-200">
                <img src="{{ $nextspace['image'] }}" alt="{{ $nextspace['title'] }}" class="w-24 h-24 object-cover rounded-lg">
                <div>
                    <p class="text-lg font-semibold text-text-primary">{{ $nextspace['title'] }}</p>
                    <p class="text-sm text-text-secondary">{{ $nextspace['address'] }}</p>
                    <p class="text-xl font-bold text-primary mt-2">${{ number_format($nextspace['price'], 2) }}</p>
                </div>
            </div>

            {{-- CORRECTED FORM ACTION (as previously discussed, this should now work) --}}
            <form method="POST" action="{{ route('payment.process') }}">                
                @csrf

                <input type="hidden" name="nextspace_id" value="{{ $nextspace_id }}">

                {{-- Time Slot Selection --}}
                <div class="mb-6">
                    <label for="time_slot" class="block text-sm font-medium text-text-primary mb-2">Select a Time Slot</label>
                    <select id="time_slot" name="selected_time_slot" class="w-full py-3 px-4 bg-gray-100 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-primary focus:border-primary">
                        <option value="">Choose a time</option>
                        @foreach ($nextspace['time_slots'] ?? [] as $slot)
                            <option value="{{ $slot }}">{{ $slot }}</option>
                        @endforeach
                    </select>
                    @error('selected_time_slot')
                        <p class="mt-2 text-error text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="card_number" class="block text-sm font-medium text-text-primary mb-2">Card Number</label>
                    <x-text-input id="card_number" class="w-full py-3 px-4 bg-gray-100 border border-gray-300 rounded-lg text-gray-800" type="text" name="card_number" required placeholder="XXXX XXXX XXXX XXXX" />
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="expiry_date" class="block text-sm font-medium text-text-primary mb-2">Expiry Date (MM/YY)</label>
                        <x-text-input id="expiry_date" class="w-full py-3 px-4 bg-gray-100 border border-gray-300 rounded-lg text-gray-800" type="text" name="expiry_date" required placeholder="12/25" />
                    </div>
                    <div>
                        <label for="cvc" class="block text-sm font-medium text-text-primary mb-2">CVC</label>
                        <x-text-input id="cvc" class="w-full py-3 px-4 bg-gray-100 border border-gray-300 rounded-lg text-gray-800" type="text" name="cvc" required placeholder="XXX" />
                    </div>
                </div>

                <x-primary-button type="submit" class="w-full bg-primary text-text-light font-semibold py-3 rounded-lg hover:bg-primary-dark transition duration-300 text-center">
                    Confirm Payment
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>