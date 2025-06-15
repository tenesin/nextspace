{{-- filepath: /Users/ishaqyudha/Projects/nextspace/resources/views/nextspaces/show.blade.php --}}
<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        {{-- Hero Section with improved overlay --}}
        <div class="relative w-full h-96 bg-cover bg-center" style="background-image: url('{{ $nextspace->image ?? 'https://placehold.co/1200x400/FFFFFF/00B4D8?text=NextSpace+Banner' }}');">
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/30 to-black/50"></div>
            
            {{-- Floating back button --}}
            <div class="absolute top-6 left-6 z-20">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white/90 backdrop-blur-sm text-gray-700 rounded-lg hover:bg-white transition-all duration-200 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>

            {{-- Price badge in hero --}}
            @if($nextspace->base_price)
                <div class="absolute top-6 right-6 z-20">
                    <div class="bg-white/95 backdrop-blur-sm px-4 py-2 rounded-lg shadow-sm">
                        <span class="text-sm text-gray-600">Starting from</span>
                        <div class="text-2xl font-bold text-primary">${{ number_format($nextspace->base_price, 2) }}</div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Main Content Container --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 -mt-24 relative z-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl">
                
                {{-- Header Section --}}
                <div class="p-8 border-b border-gray-100">
                    {{-- Breadcrumb --}}
                    <nav class="text-sm text-gray-500 mb-6">
                        <a href="{{ route('dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-700">{{ $nextspace->title }}</span>
                    </nav>

                    {{-- Title and Rating Section --}}
                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-6">
                        <div class="flex-1">
                            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $nextspace->title }}</h1>
                            
                            {{-- Rating and Reviews --}}
                            <div class="flex items-center gap-4 mb-4">
                                @if($nextspace->rating)
                                    <div class="flex items-center bg-primary/10 px-3 py-1 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <span class="text-primary font-semibold">{{ number_format($nextspace->rating, 1) }}</span>
                                    </div>
                                @endif
                                
                                @if($nextspace->reviews_count)
                                    <span class="text-gray-600">({{ $nextspace->reviews_count }} reviews)</span>
                                @endif

                                {{-- **PUT THE FAVORITE BUTTON HERE** --}}
            <form method="POST" action="{{ route('favorites.toggle', $nextspace->id) }}" class="ml-4">
                @csrf
                <button type="submit" class="text-yellow-500 hover:text-yellow-600 transition-colors">
                    @if($isFavorited)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 .587l3.69 7.568 8.31 1.205-6.005 5.854 1.416 8.281L12 18.896l-7.411 3.91 1.416-8.281-6.005-5.854 8.31-1.205L12 .587z"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.324 1.118l1.519 4.674c.3.921-.755 1.688-1.539 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.539-1.118l1.519-4.674a1 1 0 00-.324-1.118L2.285 9.102c-.783-.57-.381-1.81.588-1.81h4.914a1 1 0 00.95-.69l1.519-4.674z" />
                        </svg>
                    @endif
                </button>
            </form>
                            </div>

                            {{-- Address with icon --}}
                            <div class="flex items-start gap-2 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ $nextspace->address }}</span>
                            </div>
                        </div>

                        {{-- Time Slots Section --}}
                        <div class="lg:max-w-md">
                            @if($nextspace->timeSlots && $nextspace->timeSlots->count())
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Available Time Slots</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($nextspace->timeSlots as $slot)
                                            <span class="bg-primary text-white px-3 py-1.5 rounded-md text-sm font-medium hover:bg-primary-dark transition-colors cursor-pointer">
                                                {{ $slot->slot }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Description Section --}}
                @if($nextspace->description)
                    <div class="p-8 border-b border-gray-100">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">About This Space</h2>
                        <p class="text-gray-600 leading-relaxed text-lg">{{ $nextspace->description }}</p>
                    </div>
                @endif

                {{-- Main Content Grid --}}
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        {{-- Contact Information --}}
                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    Contact Information
                                </h3>
                                
                                <div class="space-y-4">
                                    @if($nextspace->phone)
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500">Phone</p>
                                                <a href="tel:{{ $nextspace->phone }}" class="text-primary font-medium hover:underline">{{ $nextspace->phone }}</a>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Hours Section --}}
                @if($nextspace->hours && $nextspace->hours->count())
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Hours</p>
                            <ul class="text-gray-700">
                                @foreach($nextspace->hours as $hour)
                                    <li>
                                        {{ $hour->day }}: {{ $hour->open_time }} - {{ $hour->close_time }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Hours</p>
                            <p class="text-gray-700">N/A</p>
                        </div>
                    </div>
                @endif
                                </div>
                            </div>
                        </div>

                        {{-- Amenities and Services --}}
                        <div class="lg:col-span-2 space-y-8">
                            
                            {{-- Amenities Section --}}
                            @if($nextspace->amenities && $nextspace->amenities->count())
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Amenities
                                    </h3>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                        @foreach ($nextspace->amenities as $amenity)
                                            <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-lg p-3 hover:border-primary/30 transition-colors">
                                                <div class="w-2 h-2 bg-primary rounded-full flex-shrink-0"></div>
                                                <span class="text-gray-700 text-sm font-medium">{{ $amenity->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Services Section --}}
                            @if($nextspace->services && $nextspace->services->count())
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Services Offered
                                    </h3>
                                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                                        @foreach ($nextspace->services as $index => $serviceItem)
                                            <div class="flex justify-between items-center p-4 {{ $index > 0 ? 'border-t border-gray-100' : '' }} hover:bg-gray-50 transition-colors">
                                                <span class="text-gray-700 font-medium">{{ $serviceItem->name }}</span>
                                                <span class="text-primary font-semibold text-lg">${{ number_format($serviceItem->price ?? 0, 2) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-gray-500">No services listed for this space.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                {{-- Booking Section --}}
                <div class="bg-gray-50 p-8">
                    <div class="max-w-2xl mx-auto text-center">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Ready to Book This Space?</h3>
                        <p class="text-gray-600 mb-6">Reserve your spot now and enjoy all the amenities this space has to offer.</p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            @if($nextspace->base_price)
                                <div class="text-center">
                                    <span class="text-sm text-gray-500">Starting from</span>
                                    <div class="text-3xl font-bold text-primary">${{ number_format($nextspace->base_price, 2) }}</div>
                                </div>
                            @endif
                            
                            <a href="{{ route('payment.form', ['nextspace_id' => $nextspace->id]) }}" class="inline-flex items-center justify-center bg-primary text-white font-semibold py-4 px-8 rounded-lg text-lg hover:bg-primary-dark transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z" />
                                </svg>
                                Book This Space Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>