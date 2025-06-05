<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-text-primary mb-6">Create New NextSpace</h2>

                @if ($errors->any())
                    <div class="mb-4 text-red-500">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.nextspaces.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="title" value="NextSpace Name" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus placeholder="e.g., The Creative Hub" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" value="Full Description" />
                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm" rows="4" required placeholder="Describe this NextSpace in detail..."></textarea>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="image" value="Image URL (for banner/card display)" />
                        <x-text-input id="image" name="image" type="url" class="mt-1 block w-full" :value="old('image')" placeholder="e.g., https://example.com/nextspace-image.jpg" />
                        <p class="text-xs text-gray-500 mt-1">Provide a direct link to an image for this NextSpace.</p>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="address" value="Full Address" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" required placeholder="e.g., 123 Main St, City, State, Zip" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone" value="Contact Phone Number" />
                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" placeholder="e.g., +1 (555) 123-4567" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="hours" value="Operating Hours" />
                        <x-text-input id="hours" name="hours" type="text" class="mt-1 block w-full" :value="old('hours')" placeholder="e.g., Mon-Fri: 9:00 AM - 5:00 PM" />
                    </div>

                    {{-- Rating Single-Select Dropdown --}}
                    <div class="mb-6">
                        <x-input-label for="rating_dropdown" value="Rating (Select only 1)" />
                        <div class="relative">
                            <div class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm bg-white cursor-pointer select-none" id="rating_dropdown_trigger">
                                <span id="rating_selected_display" class="text-gray-500">Select a rating...</span>
                                <div class="absolute right-2 top-1/2 -translate-y-1/2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <div id="rating_dropdown_options" class="absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg mt-1 hidden max-h-48 overflow-y-auto">
                                @for ($i = 50; $i >= 0; $i--)
                                    @php $ratingValue = $i / 10; @endphp
                                    <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-gray-800" data-value="{{ $ratingValue }}" data-name="{{ number_format($ratingValue, 1) }} ⭐">
                                        {{ number_format($ratingValue, 1) }} ⭐
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div id="rating_pills_container" class="mt-2 flex flex-wrap gap-2"></div>
                        <input type="hidden" name="rating" id="rating_hidden_input">
                        <p class="text-xs text-gray-500 mt-1">Select only one rating from 0.0 to 5.0</p>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="reviews_count" value="Number of Reviews" />
                        <x-text-input id="reviews_count" name="reviews_count" type="number" min="0" class="mt-1 block w-full" :value="old('reviews_count')" placeholder="e.g., 128" />
                        <p class="text-xs text-gray-500 mt-1">Total count of user reviews.</p>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="base_price" value="Base Price (e.g., per day/hour)" />
                        <x-text-input id="base_price" name="base_price" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('base_price')" placeholder="e.g., 50.00" />
                        <p class="text-xs text-gray-500 mt-1">The main price for this NextSpace (e.g., daily rate).</p>
                    </div>

                    {{-- Amenities --}}
                    <div class="mb-4">
                        <x-input-label for="amenities_select" value="Amenities (Select multiple)" />
                        <div class="relative">
                            <div class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm bg-white cursor-pointer select-none" id="amenities_dropdown_trigger">
                                <span id="amenities_selected_display" class="text-gray-500">Select amenities...</span>
                                <div class="absolute right-2 top-1/2 -translate-y-1/2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            <div id="amenities_dropdown_options" class="absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg mt-1 hidden max-h-48 overflow-y-auto">
                                @foreach ($amenities as $amenity)
                                    <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-gray-800" data-value="{{ $amenity->id }}" data-name="{{ $amenity->name }}">
                                        {{ $amenity->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="amenities_pills_container" class="mt-2 flex flex-wrap gap-2"></div>
                        <input type="hidden" name="amenities[]" id="amenities_hidden_input">
                        <p class="text-xs text-gray-500 mt-1">Click to select/deselect amenities (max 5).</p>
                    </div>

                    {{-- Services --}}
                    <div class="mb-4">
                        <x-input-label for="services_select" value="Services Offered (Select multiple)" />
                        <div class="relative">
                            <div class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm bg-white cursor-pointer select-none" id="services_dropdown_trigger">
                                <span id="services_selected_display" class="text-gray-500">Select services...</span>
                                <div class="absolute right-2 top-1/2 -translate-y-1/2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            <div id="services_dropdown_options" class="absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg mt-1 hidden max-h-48 overflow-y-auto">
                                @foreach ($services as $service)
                                    <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-gray-800" data-value="{{ $service->id }}" data-name="{{ $service->name }}">
                                        {{ $service->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="services_pills_container" class="mt-2 flex flex-wrap gap-2"></div>
                        <input type="hidden" name="services[]" id="services_hidden_input">
                        <p class="text-xs text-gray-500 mt-1">Click to select/deselect services (max 5).</p>
                    </div>

                    {{-- Time Slots --}}
                    <div class="mb-6">
                        <x-input-label for="time_slots_select" value="Available Time Slot (Select only 1)" />
                        <div class="relative">
                            <div class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm bg-white cursor-pointer select-none" id="time_slots_dropdown_trigger">
                                <span id="time_slots_selected_display" class="text-gray-500">Select a time slot...</span>
                                <div class="absolute right-2 top-1/2 -translate-y-1/2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            <div id="time_slots_dropdown_options" class="absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg mt-1 hidden max-h-48 overflow-y-auto">
                                @php
                                    $allTimeSlots = ["08:00 AM", "09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM", "06:00 PM", "07:00 PM", "08:00 PM"];
                                @endphp
                                @foreach ($allTimeSlots as $slot)
                                    <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-gray-800" data-value="{{ $slot }}" data-name="{{ $slot }}">
                                        {{ $slot }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="time_slots_pills_container" class="mt-2 flex flex-wrap gap-2"></div>
                        <input type="hidden" name="time_slots[]" id="time_slots_hidden_input">
                        <p class="text-xs text-gray-500 mt-1">Select only one available time slot.</p>
                    </div>

                    {{-- Submit --}}
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.nextspaces.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">Cancel</a>
                        <x-primary-button>
                            Create
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        function setupCustomSelect(triggerId, optionsId, pillsContainerId, hiddenInputId, isMultiSelect = true, maxSelection = Infinity) {
            const trigger = document.getElementById(triggerId);
            const optionsContainer = document.getElementById(optionsId);
            const pillsContainer = document.getElementById(pillsContainerId);
            const hiddenInput = document.getElementById(hiddenInputId);
            let selectedValues = new Set();

            const updateDisplay = () => {
                pillsContainer.innerHTML = '';
                const selectedNames = [];
                const selectedIds = [];

                selectedValues.forEach(itemJson => {
                    const item = JSON.parse(itemJson);
                    selectedNames.push(item.name);
                    selectedIds.push(item.id);

                    const pill = document.createElement('span');
                    pill.className = 'inline-flex items-center px-3 py-1 bg-primary text-white rounded-full text-sm';
                    pill.innerHTML = `${item.name} <span class="ml-2 cursor-pointer text-white hover:text-red-300" data-id="${item.id}">&times;</span>`;
                    pillsContainer.appendChild(pill);
                });

                hiddenInput.value = Array.from(selectedIds);

                // Update trigger display
                const display = trigger.querySelector('span');
                display.textContent = selectedNames.length ? selectedNames.join(', ') : 'Select options...';

                // Re-attach remove handlers
                pillsContainer.querySelectorAll('[data-id]').forEach(el => {
                    el.addEventListener('click', () => {
                        selectedValues.forEach(val => {
                            if (JSON.parse(val).id == el.dataset.id) {
                                selectedValues.delete(val);
                            }
                        });
                        updateDisplay();
                    });
                });
            };

            // Show/hide dropdown
            trigger.addEventListener('click', () => {
                optionsContainer.classList.toggle('hidden');
            });

            // Select/deselect logic
            optionsContainer.querySelectorAll('[data-value]').forEach(option => {
                option.addEventListener('click', () => {
                    const item = {
                        id: option.dataset.value,
                        name: option.dataset.name
                    };
                    const itemJson = JSON.stringify(item);

                    if (selectedValues.has(itemJson)) {
                        selectedValues.delete(itemJson);
                    } else {
                        if (!isMultiSelect) {
                            selectedValues.clear();
                        }
                        if (selectedValues.size < maxSelection) {
                            selectedValues.add(itemJson);
                        }
                    }
                    updateDisplay();
                    optionsContainer.classList.add('hidden');
                });
            });

            // Click outside to close dropdown
            document.addEventListener('click', (e) => {
                if (!trigger.contains(e.target) && !optionsContainer.contains(e.target)) {
                    optionsContainer.classList.add('hidden');
                }
            });
        }

        // Setup each dropdown
        setupCustomSelect('amenities_dropdown_trigger', 'amenities_dropdown_options', 'amenities_pills_container', 'amenities_hidden_input', true, 5);
        setupCustomSelect('services_dropdown_trigger', 'services_dropdown_options', 'services_pills_container', 'services_hidden_input', true, 5);
        setupCustomSelect('time_slots_dropdown_trigger', 'time_slots_dropdown_options', 'time_slots_pills_container', 'time_slots_hidden_input', false, 1);
        setupCustomSelect('rating_dropdown_trigger', 'rating_dropdown_options', 'rating_pills_container', 'rating_hidden_input', false, 1);
    });
</script>


<style>
    /* Hide the original select elements */
    select[multiple] {
        display: none !important;
    }
    select:not([multiple]) {
        display: none !important;
    }
</style>