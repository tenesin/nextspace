{{-- filepath: /Users/ishaqyudha/Projects/nextspace/resources/views/nextspaces/show.blade.php --}}
<x-app-layout>
    <div class="bg-white min-h-screen">
        {{-- Compact Hero Section --}}
        <div class="relative w-full h-64 bg-cover bg-center" style="background-image: url('{{ $nextspace->image ?? 'https://placehold.co/1200x300/F8F9FA/6B7280?text=NextSpace' }}');">
            <div class="absolute inset-0 bg-black/40"></div>
            
            {{-- Back button --}}
            <div class="absolute top-4 left-4 z-20">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3 py-2 bg-white/95 text-gray-700 rounded-md hover:bg-white transition-colors text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </a>
            </div>

            {{-- Price badge --}}
            @if($nextspace->base_price)
                <div class="absolute top-4 right-4 z-20">
                    <div class="bg-white/95 px-3 py-2 rounded-md text-right">
                        <div class="text-lg font-semibold text-gray-900">${{ number_format($nextspace->base_price, 2) }}</div>
                        <div class="text-xs text-gray-600">starting from</div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Main Content --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-10">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                
                {{-- Header --}}
                <div class="p-6 border-b border-gray-200">
                    {{-- Breadcrumb --}}
                    <nav class="text-sm text-gray-500 mb-3">
                        <a href="{{ route('dashboard') }}" class="hover:text-gray-700">Dashboard</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-700">{{ $nextspace->title }}</span>
                    </nav>

                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4">
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-gray-900 mb-3">{{ $nextspace->title }}</h1>
                            
                            {{-- Rating and Location --}}
                            <div class="flex flex-wrap items-center gap-4 mb-3">
                                @if($nextspace->rating)
                                    <div class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <span class="text-gray-700 font-medium">{{ number_format($nextspace->rating, 1) }}</span>
                                        @if($nextspace->reviews_count)
                                            <span class="text-gray-500 text-sm">({{ $nextspace->reviews_count }})</span>
                                        @endif
                                    </div>
                                @endif

                                {{-- Favorite Button --}}
                                <form method="POST" action="{{ route('favorites.toggle', $nextspace->id) }}">
                                    @csrf
                                    <button type="submit" class="text-gray-400 hover:text-gray-600 transition-colors">
                                        @if($isFavorited)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 .587l3.69 7.568 8.31 1.205-6.005 5.854 1.416 8.281L12 18.896l-7.411 3.91 1.416-8.281-6.005-5.854 8.31-1.205L12 .587z"/>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.324 1.118l1.519 4.674c.3.921-.755 1.688-1.539 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.539-1.118l1.519-4.674a1 1 0 00-.324-1.118L2.285 9.102c-.783-.57-.381-1.81.588-1.81h4.914a1 1 0 00.95-.69l1.519-4.674z" />
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                            </div>

                            {{-- Address --}}
                            <div class="flex items-center gap-2 text-gray-600 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ $nextspace->address }}</span>
                            </div>
                        </div>

                        {{-- Time Slots --}}
                        @if($nextspace->timeSlots && $nextspace->timeSlots->count())
                            <div class="lg:w-80">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h3 class="text-sm font-medium text-gray-700 mb-2">Available Times</h3>
                                    <select name="selected_time_slot_id" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-400 focus:border-gray-400 text-sm" required>
                                        <option value="">Select time</option>
                                        @foreach ($nextspace->timeSlots as $slot)
                                            <option value="{{ $slot->id }}" {{ old('selected_time_slot_id') == $slot->id ? 'selected' : '' }} @if($slot->pivot->capacity <= 0) disabled @endif>
                                                {{ $slot->slot }} ({{ $slot->pivot->capacity }} left)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Description --}}
                @if($nextspace->description)
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">About</h2>
                        <p class="text-gray-600 leading-relaxed">{{ $nextspace->description }}</p>
                    </div>
                @endif

                {{-- Main Grid --}}
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                        
                        {{-- Contact Info --}}
                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="font-semibold text-gray-900 mb-4">Contact</h3>
                                
                                @if($nextspace->phone)
                                    <div class="mb-4">
                                        <p class="text-xs text-gray-500 mb-1">Phone</p>
                                        <a href="tel:{{ $nextspace->phone }}" class="text-gray-700 hover:text-gray-900 text-sm font-medium">{{ $nextspace->phone }}</a>
                                    </div>
                                @endif

                                {{-- Hours --}}
                                <div>
                                    <p class="text-xs text-gray-500 mb-2">Hours</p>
                                    @if($nextspace->hours && $nextspace->hours->count())
                                        <div class="text-sm text-gray-700 space-y-1">
                                            @foreach($nextspace->hours as $hour)
                                                <div class="flex justify-between">
<span>
    {{ $hour->day_type === 'mon-fri' ? 'Monday - Friday' : 'Saturday - Sunday' }}
</span>                                                    <span>{{ $hour->open_time }}-{{ $hour->close_time }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-500">Not specified</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Amenities & Services --}}
                        <div class="lg:col-span-3 space-y-6">
                            
                            {{-- Amenities --}}
                            @if($nextspace->amenities && $nextspace->amenities->count())
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-3">Amenities</h3>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                        @foreach ($nextspace->amenities as $amenity)
                                            <div class="flex items-center gap-2 p-2 bg-gray-50 rounded text-sm">
                                                <div class="w-1.5 h-1.5 bg-gray-400 rounded-full"></div>
                                                <span class="text-gray-700">{{ $amenity->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Services --}}
                            @if($nextspace->services && $nextspace->services->count())
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-3">Services & Pricing</h3>
                                    <div class="bg-gray-50 rounded-lg divide-y divide-gray-200">
                                        @foreach ($nextspace->services as $serviceItem)
                                            <div class="flex justify-between items-center p-3">
                                                <span class="text-gray-700 text-sm">{{ $serviceItem->name }}</span>
                                                <span class="font-semibold text-gray-900">${{ number_format($serviceItem->price ?? 0, 2) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Booking Section --}}
                <div class="bg-gray-50 p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Ready to Book?</h3>
                    <p class="text-gray-600 mb-4 text-sm">Reserve your spot and enjoy this space.</p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        @if($nextspace->base_price)
                            <div class="text-center">
                                <div class="text-xl font-bold text-gray-900">${{ number_format($nextspace->base_price, 2) }}</div>
                                <div class="text-xs text-gray-500">starting price</div>
                            </div>
                        @endif
                        
                        <a href="{{ route('payment.form', ['nextspace_id' => $nextspace->id]) }}" class="inline-flex items-center justify-center bg-gray-900 text-white font-medium py-3 px-6 rounded-md hover:bg-gray-800 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z" />
                            </svg>
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>