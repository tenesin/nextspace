{{-- filepath: resources/views/admin/nextspaces/create.blade.php --}}
<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-t-xl shadow-sm p-6 border-b">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m5 0v-4a1 1 0 011-1h2a1 1 0 011 1v4m-5 0v-6a1 1 0 011-1h2a1 1 0 011 1v6"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Add New Workspace</h1>
                        <p class="text-gray-500">Fill in the details to create a new NextSpace location</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.nextspaces.store') }}" class="bg-white rounded-b-xl shadow-sm">
                @csrf
                
                <!-- Basic Information -->
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                        Basic Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Workspace Name <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="e.g., Downtown Creative Hub"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                   required>
                            @error('title')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input type="tel" 
                                   name="phone" 
                                   value="{{ old('phone') }}" 
                                   placeholder="e.g., +62 21 1234 5678"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Address <span class="text-red-400">*</span>
                        </label>
                        <input type="text" 
                               name="address" 
                               value="{{ old('address') }}" 
                               placeholder="Enter the complete address"
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                               required>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description <span class="text-red-400">*</span>
                        </label>
                        <textarea name="description" 
                                  rows="4"
                                  placeholder="Describe the workspace, its atmosphere, and what makes it special..."
                                  class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none" 
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Pricing & Rating -->
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                        Pricing & Rating
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Base Price (IDR) <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-3 text-gray-500">Rp</span>
                                <input type="number" 
                                       step="1000" 
                                       name="base_price" 
                                       value="{{ old('base_price') }}" 
                                       placeholder="50000"
                                       class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                       required>
                            </div>
                            @error('base_price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <select name="rating" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                <option value="">Select rating</option>
                                <option value="5.0" {{ old('rating') == '5.0' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5.0)</option>
                                <option value="4.5" {{ old('rating') == '4.5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (4.5)</option>
                                <option value="4.0" {{ old('rating') == '4.0' ? 'selected' : '' }}>⭐⭐⭐⭐ (4.0)</option>
                                <option value="3.5" {{ old('rating') == '3.5' ? 'selected' : '' }}>⭐⭐⭐⭐ (3.5)</option>
                                <option value="3.0" {{ old('rating') == '3.0' ? 'selected' : '' }}>⭐⭐⭐ (3.0)</option>
                            </select>
                            @error('rating')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Reviews Count</label>
                            <input type="number" 
                                   name="reviews_count" 
                                   value="{{ old('reviews_count', 0) }}" 
                                   placeholder="0"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            @error('reviews_count')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>
                        Workspace Image
                    </h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Image URL</label>
                        <input type="url" 
                               name="image" 
                               value="{{ old('image') }}" 
                               placeholder="https://example.com/workspace-image.jpg"
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <p class="text-sm text-gray-500 mt-1">Add a URL to an image that showcases your workspace</p>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Amenities & Services -->
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                        Features & Services
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Amenities -->
                        <div>
                            <h4 class="font-medium text-gray-700 mb-3">Amenities</h4>
                            <div class="space-y-3 max-h-40 overflow-y-auto">
                                @foreach($amenities as $amenity)
                                    <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="checkbox" 
                                               name="amenity_ids[]" 
                                               value="{{ $amenity->id }}"
                                               {{ in_array($amenity->id, old('amenity_ids', [])) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="ml-3 text-sm text-gray-700">{{ $amenity->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('amenity_ids')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Services -->
                        <div>
                            <h4 class="font-medium text-gray-700 mb-3">Services</h4>
                            <div class="space-y-3 max-h-40 overflow-y-auto">
                                @foreach($services as $service)
                                    <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="checkbox" 
                                               name="service_ids[]" 
                                               value="{{ $service->id }}"
                                               {{ in_array($service->id, old('service_ids', [])) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="ml-3 text-sm text-gray-700">{{ $service->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('service_ids')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Time Slots -->
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="w-2 h-2 bg-red-500 rounded-full mr-3"></span>
                        Available Time Slots
                    </h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @foreach($timeSlots as $slot)
                            <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 cursor-pointer transition-all">
                                <input type="checkbox" 
                                       name="time_slot_ids[]" 
                                       value="{{ $slot->id }}"
                                       {{ in_array($slot->id, old('time_slot_ids', [])) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm font-medium text-gray-700">{{ $slot->slot }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('time_slot_ids')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="p-6 bg-gray-50 rounded-b-xl">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.nextspaces.index') }}" 
                           class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                            </svg>
                            Cancel
                        </a>
                        
                        <button type="submit" 
                                class="inline-flex items-center px-8 py-3 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create Workspace
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>