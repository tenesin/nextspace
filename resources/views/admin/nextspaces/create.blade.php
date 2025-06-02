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

                    <div class="mb-4">
                        <x-input-label for="rating" value="Rating (0.0 to 5.0)" />
                        <select id="rating" name="rating" class="mt-1 block w-full border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm">
                            <option value="">Select a rating</option>
                            @for ($i = 50; $i >= 0; $i--)
                                @php $ratingValue = $i / 10; @endphp
                                <option value="{{ $ratingValue }}" {{ old('rating') == $ratingValue ? 'selected' : '' }}>
                                    {{ number_format($ratingValue, 1) }}
                                </option>
                            @endfor
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Select a rating from the list.</p>
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

                    {{-- Amenities Multi-Select Dropdown with Pills --}}
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
                        <input type="hidden" name="amenities[]" id="amenities_hidden_input"> {{-- Hidden input for form submission --}}
                        <p class="text-xs text-gray-500 mt-1">Click to select/deselect amenities (max 5).</p>
                    </div>

                    {{-- Services Multi-Select Dropdown with Pills --}}
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
                        <input type="hidden" name="services[]" id="services_hidden_input"> {{-- Hidden input for form submission --}}
                        <p class="text-xs text-gray-500 mt-1">Click to select/deselect services (max 5).</p>
                    </div>

                    {{-- Time Slot Single-Select Dropdown with Pill --}}
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
                        <input type="hidden" name="time_slots[]" id="time_slots_hidden_input"> {{-- Hidden input for form submission --}}
                        <p class="text-xs text-gray-500 mt-1">Select only one available time slot.</p>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.nextspaces.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">Cancel</a>
                        <x-primary-button>
                            Create NextSpace
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to initialize and manage custom select dropdowns
        function setupCustomSelect(triggerId, optionsId, pillsContainerId, hiddenInputId, isMultiSelect = true, maxSelection = Infinity) {
            const trigger = document.getElementById(triggerId);
            const optionsContainer = document.getElementById(optionsId);
            const pillsContainer = document.getElementById(pillsContainerId);
            const hiddenInput = document.getElementById(hiddenInputId);
            let selectedValues = new Set(); // Use Set for efficient add/delete and uniqueness

            // Function to update hidden input and pills display
            const updateDisplay = () => {
                pillsContainer.innerHTML = '';
                const currentSelectedNames = [];
                const currentSelectedIds = [];

                selectedValues.forEach(itemJson => {
                    const item = JSON.parse(itemJson); // Parse back to object
                    currentSelectedNames.push(item.name);
                    currentSelectedIds.push(item.value);

                    const pill = document.createElement('span');
                    pill.className = 'inline-flex items-center bg-primary-light text-primary px-3 py-1 rounded-full text-sm font-medium cursor-pointer';
                    pill.innerHTML = `${item.name} <svg class="w-3 h-3 ml-1.5 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24" data-value="${item.value}" data-name="${item.name}"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>`;
                    pill.querySelector('svg').addEventListener('click', (e) => {
                        e.stopPropagation(); // Prevent dropdown from re-opening
                        selectedValues.delete(itemJson);
                        updateDisplay();
                        updateOptionState(item.value, false);
                    });
                    pillsContainer.appendChild(pill);
                });

                // Update the hidden input for form submission
                if (isMultiSelect) {
                    hiddenInput.value = JSON.stringify(currentSelectedIds); // Store array of IDs
                    hiddenInput.name = hiddenInput.id; // Ensure name is correct for array submission
                } else {
                    hiddenInput.value = currentSelectedIds.length > 0 ? currentSelectedIds[0] : ''; // Store single ID or empty
                    hiddenInput.name = hiddenInput.id.replace('[]', ''); // Ensure name is correct for single submission
                }
                
                // Update dropdown trigger text
                if (currentSelectedNames.length === 0) {
                    trigger.querySelector('span').textContent = `Select ${triggerId.replace('_dropdown_trigger', '').replace('_', ' ')}...`;
                    trigger.querySelector('span').classList.add('text-gray-500');
                } else {
                    trigger.querySelector('span').textContent = currentSelectedNames.join(', ');
                    trigger.querySelector('span').classList.remove('text-gray-500');
                }

                // Update original hidden select element's options (if it exists)
                const originalSelect = document.getElementById(triggerId.replace('_dropdown_trigger', ''));
                if (originalSelect && originalSelect.tagName === 'SELECT') {
                    Array.from(originalSelect.options).forEach(option => {
                        option.selected = currentSelectedIds.includes(parseInt(option.value)) || currentSelectedIds.includes(option.value); // Handle string/int comparison
                    });
                }
            };

            // Function to update the visual state of an option in the dropdown
            const updateOptionState = (value, isSelected) => {
                const optionDiv = optionsContainer.querySelector(`div[data-value="${value}"]`);
                if (optionDiv) {
                    if (isSelected) {
                        optionDiv.classList.add('bg-primary-light', 'text-primary');
                        optionDiv.classList.remove('hover:bg-gray-100');
                    } else {
                        optionDiv.classList.remove('bg-primary-light', 'text-primary');
                        optionDiv.classList.add('hover:bg-gray-100');
                    }
                }
            };

            // Toggle dropdown visibility
            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                optionsContainer.classList.toggle('hidden');
            });

            // Handle option click
            optionsContainer.addEventListener('click', (e) => {
                const optionDiv = e.target.closest('div[data-value]');
                if (optionDiv) {
                    const value = optionDiv.dataset.value;
                    const name = optionDiv.dataset.name;
                    const itemJson = JSON.stringify({ value: value, name: name });

                    if (isMultiSelect) {
                        if (selectedValues.has(itemJson)) {
                            selectedValues.delete(itemJson);
                            updateOptionState(value, false);
                        } else if (selectedValues.size < maxSelection) {
                            selectedValues.add(itemJson);
                            updateOptionState(value, true);
                        }
                    } else { // Single select
                        selectedValues.clear();
                        selectedValues.add(itemJson);
                        Array.from(optionsContainer.children).forEach(child => {
                            updateOptionState(child.dataset.value, false);
                        });
                        updateOptionState(value, true);
                        optionsContainer.classList.add('hidden'); // Close dropdown on single select
                    }
                    updateDisplay();
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!trigger.contains(e.target) && !optionsContainer.contains(e.target)) {
                    optionsContainer.classList.add('hidden');
                }
            });

            // Initialize with old values (for validation errors)
            const initialOldValues = JSON.parse(hiddenInput.value || '[]');
            initialOldValues.forEach(val => {
                const optionDiv = optionsContainer.querySelector(`div[data-value="${val}"]`);
                if (optionDiv) {
                    selectedValues.add(JSON.stringify({ value: val, name: optionDiv.dataset.name }));
                    updateOptionState(val, true);
                }
            });
            updateDisplay();
        }

        // Setup for Amenities
        setupCustomSelect('amenities_dropdown_trigger', 'amenities_dropdown_options', 'amenities_pills_container', 'amenities_hidden_input', true, 5);

        // Setup for Services
        setupCustomSelect('services_dropdown_trigger', 'services_dropdown_options', 'services_pills_container', 'services_hidden_input', true, 5);

        // Setup for Time Slots (single select)
        setupCustomSelect('time_slots_dropdown_trigger', 'time_slots_dropdown_options', 'time_slots_pills_container', 'time_slots_hidden_input', false, 1);
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
