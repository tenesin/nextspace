{{-- filepath: resources/views/admin/nextspaces/edit.blade.php --}}
<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4">
            {{-- Header --}}
            <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-900">Edit NextSpace</h1>
                        <p class="text-gray-600 text-sm">Update space information</p>
                    </div>
                    <a href="{{ route('admin.nextspaces.index') }}" 
                       class="text-gray-500 hover:text-blue-600 flex items-center text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back
                    </a>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.nextspaces.update', $nextspace->id) }}" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Basic Information --}}
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <h3 class="font-medium text-gray-900 mb-3">Basic Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm text-gray-700 mb-1">
                                Space Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title', $nextspace->title) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="e.g., Modern Co-working Space"
                                   required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm text-gray-700 mb-1">
                                Address <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="address" 
                                   value="{{ old('address', $nextspace->address) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="e.g., Jl. Sudirman No. 123, Jakarta"
                                   required>
                            @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" 
                                   name="phone" 
                                   value="{{ old('phone', $nextspace->phone) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="+62 21 1234567">
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-gray-700 mb-1">
                                Base Price (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   step="1000" 
                                   name="base_price" 
                                   value="{{ old('base_price', $nextspace->base_price) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="50000"
                                   required>
                            @error('base_price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        @php
                            $existingHours = $nextspace->hours->pluck('day_type')->toArray();
                        @endphp

                        <div class="md:col-span-2">
                            <label class="block text-sm text-gray-700 mb-2">Operating Hours</label>
                            <div class="flex flex-wrap gap-4">
                                <label class="flex items-center">
                                    <input type="checkbox" name="hours[]" value="Monday - Friday 08:00 - 17:00"
                                        {{ (is_array(old('hours')) && in_array('Monday - Friday 08:00 - 17:00', old('hours')))
                                            || (!old('hours') && in_array('mon-fri', $existingHours)) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm">Mon-Fri 08:00-17:00</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="hours[]" value="Saturday - Sunday 08:00 - 17:00"
                                        {{ (is_array(old('hours')) && in_array('Saturday - Sunday 08:00 - 17:00', old('hours')))
                                            || (!old('hours') && in_array('sat-sun', $existingHours)) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm">Sat-Sun 08:00-17:00</span>
                                </label>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm text-gray-700 mb-1">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea name="description" 
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 resize-none"
                                      placeholder="Describe your space..."
                                      required>{{ old('description', $nextspace->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Media & Rating --}}
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <h3 class="font-medium text-gray-900 mb-3">Media & Rating</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm text-gray-700 mb-1">Image URL</label>
                            <input type="url" 
                                   name="image" 
                                   value="{{ old('image', $nextspace->image) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="https://example.com/image.jpg">
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Rating (0-5)</label>
                            <input type="number" 
                                   step="0.1" 
                                   min="0" 
                                   max="5" 
                                   name="rating" 
                                   value="{{ old('rating', $nextspace->rating) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="4.5">
                            @error('rating')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Reviews Count</label>
                            <input type="number" 
                                   min="0"
                                   name="reviews_count" 
                                   value="{{ old('reviews_count', $nextspace->reviews_count) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="25">
                            @error('reviews_count')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Amenities --}}
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <h3 class="font-medium text-gray-900 mb-3">Amenities</h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                        @foreach($allAmenities as $amenity)
                            <label class="flex items-center p-2 border border-gray-200 rounded hover:border-blue-300 cursor-pointer">
                                <input type="checkbox" 
                                       name="amenity_ids[]" 
                                       value="{{ $amenity->id }}"
                                       class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                       {{ in_array($amenity->id, old('amenity_ids', $nextspace->amenities->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm">{{ $amenity->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('amenity_ids')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Services --}}
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <h3 class="font-medium text-gray-900 mb-3">Additional Services</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        @foreach($allServices as $service)
                            <label class="flex items-center justify-between p-2 border border-gray-200 rounded hover:border-blue-300 cursor-pointer">
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="service_ids[]" 
                                           value="{{ $service->id }}"
                                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                           {{ in_array($service->id, old('service_ids', $nextspace->services->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm">{{ $service->name }}</span>
                                </div>
                                @if(isset($service->price))
                                    <span class="text-xs text-blue-600">+Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                                @endif
                            </label>
                        @endforeach
                    </div>
                    @error('service_ids')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Time Slots --}}
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <h3 class="font-medium text-gray-900 mb-3">Available Time Slots</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        @foreach($allTimeSlots as $slot)
                            <div class="flex items-center justify-between p-2 border border-gray-200 rounded">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="time_slot_ids[]" value="{{ $slot->id }}"
                                        {{ $nextspace->timeSlots->contains($slot->id) ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm">{{ $slot->slot }}</span>
                                </label>
                                <select name="capacities[{{ $slot->id }}]" class="border border-gray-300 rounded px-2 py-1 text-sm w-16">
                                    @for($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}"
                                            @if(($nextspace->timeSlots->find($slot->id)?->pivot->capacity ?? 1) == $i) selected @endif>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        @endforeach
                    </div>
                    @error('time_slot_ids')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('admin.nextspaces.index') }}" 
                       class="px-4 py-2 text-gray-600 bg-gray-100 rounded hover:bg-gray-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Update Space
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Add visual feedback for checkbox selections
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const label = this.closest('label');
                if (this.checked) {
                    label.classList.add('border-blue-500', 'bg-blue-50');
                } else {
                    label.classList.remove('border-blue-500', 'bg-blue-50');
                }
            });
            
            // Set initial state
            if (checkbox.checked) {
                checkbox.closest('label').classList.add('border-blue-500', 'bg-blue-50');
            }
        });
    </script>
</x-app-layout>