<x-app-layout>
    <div class="py-8 bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Edit Workspace</h1>
                        <p class="text-gray-600 mt-1">Make changes to your workspace listing</p>
                    </div>
                    <a href="{{ route('admin.nextspaces.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.nextspaces.update', $nextspace->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Current Preview
                    </h2>
                    <div class="flex items-start space-x-6 p-4 bg-gray-50 rounded-lg">
                        <img src="{{ $nextspace->image ?? 'https://placehold.co/120x120/E0F2F7/00B4D8?text=No+Image' }}"
                             alt="{{ $nextspace->title }}"
                             class="w-24 h-24 object-cover rounded-lg shadow-sm border-2 border-white">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $nextspace->title }}</h3>
                            <p class="text-gray-600 flex items-center mt-1">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $nextspace->address }}
                            </p>
                            <div class="flex items-center space-x-4 mt-2">
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400 mr-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($nextspace->rating ?? 0))
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-sm text-gray-600">{{ number_format($nextspace->rating, 1) ?? 'N/A' }} ({{ $nextspace->reviews_count ?? 0 }} reviews)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Basic Information
                    </h2>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Workspace Name *
                            </label>
                            <input id="title" name="title" type="text" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                   value="{{ old('title', $nextspace->title) }}" 
                                   placeholder="Enter workspace name" required>
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                Image URL
                            </label>
                            <input id="image" name="image" type="url" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                   value="{{ old('image', $nextspace->image) }}" 
                                   placeholder="https://example.com/image.jpg">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description *
                        </label>
                        <textarea id="description" name="description" rows="4" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                  placeholder="Describe your workspace..." required>{{ old('description', $nextspace->description) }}</textarea>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Location & Contact
                    </h2>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                Address *
                            </label>
                            <input id="address" name="address" type="text" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                   value="{{ old('address', $nextspace->address) }}" 
                                   placeholder="Enter full address" required>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input id="phone" name="phone" type="tel" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                   value="{{ old('phone', $nextspace->phone) }}" 
                                   placeholder="+1 (555) 123-4567">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="hours" class="block text-sm font-medium text-gray-700 mb-2">
                            Operating Hours
                        </label>
                        <input id="hours" name="hours" type="text" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                               value="{{ old('hours', $nextspace->hours) }}" 
                               placeholder="e.g., Mon-Fri: 8AM-6PM, Sat-Sun: 9AM-5PM">
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        Rating & Reviews
                    </h2>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">
                                Rating (0-5 stars)
                            </label>
                            <select id="rating" name="rating" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">Select a rating</option>
                                @for ($i = 50; $i >= 0; $i--)
                                    @php $ratingValue = $i / 10; @endphp
                                    <option value="{{ $ratingValue }}" {{ old('rating', $nextspace->rating) == $ratingValue ? 'selected' : '' }}>
                                        {{ number_format($ratingValue, 1) }} ⭐
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label for="reviews_count" class="block text-sm font-medium text-gray-700 mb-2">
                                Number of Reviews
                            </label>
                            <input id="reviews_count" name="reviews_count" type="number" min="0" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                   value="{{ old('reviews_count', $nextspace->reviews_count) }}" 
                                   placeholder="0">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                        Pricing
                    </h2>
                    
                    <div>
                        <label for="base_price" class="block text-sm font-medium text-gray-700 mb-2">
                            Base Price (per hour/day)
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input id="base_price" name="base_price" type="number" step="0.01" min="0" 
                                   class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                   value="{{ old('base_price', $nextspace->base_price) }}" 
                                   placeholder="25.00">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Amenities
                    </h2>
                    <p class="text-gray-600 mb-4">Add the amenities available at your workspace</p>
                    
                    <div>
                        <label for="amenities" class="block text-sm font-medium text-gray-700 mb-2">
                            Available Amenities
                        </label>
                        <textarea id="amenities" name="amenities" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors font-mono text-sm" 
                                  placeholder='["WiFi", "Parking", "Coffee", "Printer", "Meeting Rooms"]'>{{ old('amenities', json_encode($nextspace->amenities, JSON_PRETTY_PRINT)) }}</textarea>
                        <p class="text-xs text-gray-500 mt-2">💡 Enter as a JSON array. Example: ["WiFi", "Parking", "Coffee"]</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"/>
                        </svg>
                        Services & Packages
                    </h2>
                    <p class="text-gray-600 mb-4">Define the services and pricing packages you offer</p>
                    
                    <div>
                        <label for="services" class="block text-sm font-medium text-gray-700 mb-2">
                            Services & Pricing
                        </label>
                        <textarea id="services" name="services" rows="6" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors font-mono text-sm" 
                                  placeholder='[{"name": "Day Pass", "price": "$30"}, {"name": "Weekly Pass", "price": "$120"}, {"name": "Monthly Pass", "price": "$400"}]'>{{ old('services', json_encode($nextspace->services, JSON_PRETTY_PRINT)) }}</textarea>
                        <p class="text-xs text-gray-500 mt-2">💡 Enter as a JSON array of objects with "name" and "price" fields</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Available Time Slots
                    </h2>
                    <p class="text-gray-600 mb-4">Set the available booking time slots for your workspace</p>
                    
                    <div>
                        <label for="time_slots" class="block text-sm font-medium text-gray-700 mb-2">
                            Time Slots
                        </label>
                        <textarea id="time_slots" name="time_slots" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors font-mono text-sm" 
                                  placeholder='["08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00"]'>{{ old('time_slots', json_encode($nextspace->time_slots, JSON_PRETTY_PRINT)) }}</textarea>
                        <p class="text-xs text-gray-500 mt-2">💡 Enter as a JSON array using 24-hour format. Example: ["09:00", "10:00", "11:00"]</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <button type="button" onclick="window.history.back()" 
                                class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cancel Changes
                        </button>
                        
                        <button type="submit" 
                                class="inline-flex items-center px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Workspace
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto-format JSON fields
        document.addEventListener('DOMContentLoaded', function() {
            const jsonFields = ['amenities', 'services', 'time_slots'];
            
            jsonFields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field) {
                    field.addEventListener('blur', function() {
                        try {
                            const parsed = JSON.parse(this.value);
                            this.value = JSON.stringify(parsed, null, 2);
                            this.classList.remove('border-red-300');
                            this.classList.add('border-gray-300');
                        } catch (e) {
                            this.classList.remove('border-gray-300');
                            this.classList.add('border-red-300');
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>