{{-- filepath: resources/views/admin/nextspaces/create.blade.php --}}
<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m5 0v-4a1 1 0 011-1h2a1 1 0 011 1v4m-5 0v-6a1 1 0 011-1h2a1 1 0 011 1v6"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-gray-900">Add New Workspace</h1>
                        <p class="text-sm text-gray-600">Create a new NextSpace location</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.nextspaces.store') }}" class="bg-white rounded-lg shadow-sm p-6">
                @csrf
                
                <!-- Basic Information -->
                <div class="mb-6">
                    <h3 class="text-base font-medium text-gray-900 mb-4">Basic Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Workspace Name <span class="text-blue-600">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="e.g., Downtown Creative Hub"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" 
                                   required>
                            @error('title')
                                <p class="text-blue-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="tel" 
                                   name="phone" 
                                   value="{{ old('phone') }}" 
                                   placeholder="+62 21 1234 5678"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            @error('phone')
                                <p class="text-blue-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Address <span class="text-blue-600">*</span>
                        </label>
                        <input type="text" 
                               name="address" 
                               value="{{ old('address') }}" 
                               placeholder="Complete address"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" 
                               required>
                        @error('address')
                            <p class="text-blue-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description <span class="text-blue-600">*</span>
                        </label>
                        <textarea name="description" 
                                  rows="3"
                                  placeholder="Describe the workspace and what makes it special..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm resize-none" 
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-blue-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Pricing & Details -->
                <div class="mb-6 border-t pt-6">
                    <h3 class="text-base font-medium text-gray-900 mb-4">Pricing & Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Base Price (IDR) <span class="text-blue-600">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500 text-sm">Rp</span>
                                <input type="number" 
                                       step="1000" 
                                       name="base_price" 
                                       value="{{ old('base_price') }}" 
                                       placeholder="50000"
                                       class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" 
                                       required>
                            </div>
                            @error('base_price')
                                <p class="text-blue-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                            <select name="rating" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="">Select rating</option>
                                <option value="5.0" {{ old('rating') == '5.0' ? 'selected' : '' }}>5.0 ⭐⭐⭐⭐⭐</option>
                                <option value="4.5" {{ old('rating') == '4.5' ? 'selected' : '' }}>4.5 ⭐⭐⭐⭐⭐</option>
                                <option value="4.0" {{ old('rating') == '4.0' ? 'selected' : '' }}>4.0 ⭐⭐⭐⭐</option>
                                <option value="3.5" {{ old('rating') == '3.5' ? 'selected' : '' }}>3.5 ⭐⭐⭐⭐</option>
                                <option value="3.0" {{ old('rating') == '3.0' ? 'selected' : '' }}>3.0 ⭐⭐⭐</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Reviews Count</label>
                            <input type="number" 
                                   name="reviews_count" 
                                   value="{{ old('reviews_count', 0) }}" 
                                   placeholder="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                            <input type="url" 
                                   name="image" 
                                   value="{{ old('image') }}" 
                                   placeholder="https://example.com/image.jpg"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        </div>
                    </div>
                </div>

                <!-- Operating Hours -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Hours <span class="text-gray-400">(choose one or both)</span>
                    </label>
                    <div class="flex items-center gap-6 mb-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="hours[]" value="Monday - Friday 08:00 - 17:00"
                                {{ (is_array(old('hours', explode(',', $nextspace->hours ?? ''))) && in_array('Monday - Friday 08:00 - 17:00', old('hours', explode(',', $nextspace->hours ?? '')))) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Monday - Friday 08:00 - 17:00</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="hours[]" value="Saturday - Sunday 08:00 - 17:00"
                                {{ (is_array(old('hours', explode(',', $nextspace->hours ?? ''))) && in_array('Saturday - Sunday 08:00 - 17:00', old('hours', explode(',', $nextspace->hours ?? '')))) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Saturday - Sunday 08:00 - 17:00</span>
                        </label>
                    </div>
                    @error('hours')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Features & Services -->
                <div class="mb-6 border-t pt-6">
                    <h3 class="text-base font-medium text-gray-900 mb-4">Features & Services</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Amenities -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Amenities</h4>
                            <div class="max-h-32 overflow-y-auto border border-gray-200 rounded-md p-2">
                                @foreach($amenities as $amenity)
                                    <label class="flex items-center py-1 hover:bg-gray-50 px-2 rounded cursor-pointer">
                                        <input type="checkbox" 
                                               name="amenity_ids[]" 
                                               value="{{ $amenity->id }}"
                                               {{ in_array($amenity->id, old('amenity_ids', [])) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 mr-2">
                                        <span class="text-sm text-gray-700">{{ $amenity->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Services -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Services</h4>
                            <div class="max-h-32 overflow-y-auto border border-gray-200 rounded-md p-2">
                                @foreach($services as $service)
                                    <label class="flex items-center py-1 hover:bg-gray-50 px-2 rounded cursor-pointer">
                                        <input type="checkbox" 
                                               name="service_ids[]" 
                                               value="{{ $service->id }}"
                                               {{ in_array($service->id, old('service_ids', [])) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 mr-2">
                                        <span class="text-sm text-gray-700">{{ $service->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Time Slots -->
                <div class="mb-6 border-t pt-6">
                    <h3 class="text-base font-medium text-gray-900 mb-4">Available Time Slots</h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                        @foreach($timeSlots as $slot)
                            <label class="flex items-center justify-between p-2 border border-gray-200 rounded-md hover:bg-blue-50 hover:border-blue-300 cursor-pointer text-sm">
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="time_slot_ids[]" 
                                           value="{{ $slot->id }}"
                                           {{ in_array($slot->id, old('time_slot_ids', [])) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 mr-2">
                                    <span class="text-gray-700">{{ $slot->slot }}</span>
                                </div>
                                <select name="capacities[{{ $slot->id }}]" class="border border-gray-300 rounded px-1 py-0.5 w-12 text-xs">
                                    @for($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}" {{ old('capacities.' . $slot->id, 1) == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t">
                    <a href="{{ route('admin.nextspaces.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                        </svg>
                        Cancel
                    </a>
                    
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create Workspace
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>