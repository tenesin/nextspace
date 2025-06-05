<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                {{-- Main Content Area (Our Place) --}}
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                        <div class="flex justify-between items-center mb-8">
                            <h2 class="text-2xl font-semibold text-text-primary">Our Place</h2>
                            <span class="text-sm text-gray-500">{{ $nextspaces->count() }} spaces available</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                            @if ($nextspaces->isEmpty())
                                <div class="col-span-full py-12 flex flex-col items-center justify-center bg-gray-50 rounded-lg border border-gray-200 border-dashed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <p class="text-text-secondary text-center">No NextSpaces available yet. Please check back later!</p>
                                </div>
                            @else
                                @foreach ($nextspaces as $nextspace)
                                    @php
                                        // Safely get amenity IDs and fetch names for display
                                        $rawAmenityIds = $nextspace->amenities ?? [];
                                        $amenityIds = is_string($rawAmenityIds) ? json_decode($rawAmenityIds, true) : $rawAmenityIds;
                                        $amenityIds = is_array($amenityIds) ? $amenityIds : [];
                                        $displayAmenities = \App\Models\Amenity::whereIn('id', $amenityIds)->pluck('name')->implode(', ');

                                        // Safely get service IDs and fetch names for display
                                        $rawServiceIds = $nextspace->services ?? [];
                                        $serviceIds = is_string($rawServiceIds) ? json_decode($rawServiceIds, true) : $rawServiceIds;
                                        $serviceIds = is_array($serviceIds) ? $serviceIds : [];
                                        $displayServices = \App\Models\Service::whereIn('id', $serviceIds)->pluck('name')->implode(', ');

                                        // Safely get time slot IDs and fetch names for display
                                        $rawTimeSlotIds = $nextspace->time_slots ?? [];
                                        $timeSlotIds = is_string($rawTimeSlotIds) ? json_decode($rawTimeSlotIds, true) : $rawTimeSlotIds;
                                        $timeSlotIds = is_array($timeSlotIds) ? $timeSlotIds : [];
                                        $displayTimeSlots = \App\Models\TimeSlot::whereIn('id', $timeSlotIds)->pluck('slot')->toArray();

                                        // Safely get hours and ensure it's an array for implode
                                        $rawHours = $nextspace->hours ?? 'N/A';
                                        $displayHours = is_string($rawHours) ? json_decode($rawHours, true) : $rawHours;
                                        $displayHours = is_array($displayHours) ? implode(', ', $displayHours) : ($rawHours ?? 'N/A');
                                    @endphp
                                    <x-product-card
                                        imageUrl="{{ $nextspace->image ?? 'https://placehold.co/400x250/E0F2F7/00B4D8?text=NextSpace+Image' }}"
                                        title="{{ $nextspace->title }}"
                                        addressLine1="{{ $nextspace->address }}"
                                        addressLine2=""
                                        hours="{{ $displayHours }}"
                                        :timeSlots="$displayTimeSlots"
                                        :detailUrl="route('nextspaces.show', ['id' => $nextspace->id])"
                                        class="group transition-all duration-300 hover:shadow-lg"
                                    >
                                        <div class="space-y-3">
                                            {{-- Amenities with icon --}}
                                            @if(!empty($displayAmenities))
                                                <div class="flex items-start gap-2 text-sm text-gray-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span class="line-clamp-1">{{ $displayAmenities }}</span>
                                                </div>
                                            @endif

                                            {{-- Services with icon --}}
                                            @if(!empty($displayServices))
                                                <div class="flex items-start gap-2 text-sm text-gray-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                    <span class="line-clamp-1">{{ $displayServices }}</span>
                                                </div>
                                            @endif

                                            {{-- Time Slots with icon --}}
                                            @if(!empty($displayTimeSlots))
                                                <div class="flex items-start gap-2 text-sm text-gray-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="line-clamp-2">{{ implode(', ', $displayTimeSlots) }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Conditional Admin Actions for Dashboard --}}
                                        @auth
                                            @if (Auth::user()->role === 'admin')
                                                <div class="flex justify-end gap-2 mt-4 pt-4 border-t border-gray-100">
                                                    <a href="{{ route('admin.nextspaces.edit', $nextspace->id) }}" class="text-primary hover:text-primary-dark text-sm font-medium inline-flex items-center transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('admin.nextspaces.destroy', $nextspace->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium inline-flex items-center transition-colors" onclick="return confirm('Are you sure you want to delete this NextSpace?');">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth

                                        {{-- View Details Button --}}
                                        <div class="mt-4 text-center">
                                            <a href="{{ route('nextspaces.show', ['id' => $nextspace->id]) }}" class="inline-flex items-center justify-center w-full py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200">
                                                View Details
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </x-product-card>
                                @endforeach
                                <div class="mt-8">
        {{ $nextspaces->links() }}
    </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Sidebar Area (with improved styling) --}}
                <div class="lg:col-span-1 mt-8 lg:mt-0 space-y-8">
                    {{-- Your Savings Section --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 transition-all duration-300 hover:shadow-md">
                        <h3 class="text-lg font-semibold text-text-primary mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Your Savings
                        </h3>
                        <div class="text-4xl font-bold text-primary text-center py-4">
                            <span class="relative inline-block">
                                <span class="absolute -top-2 left-0 text-sm">$</span>
                                <span class="ml-3">20</span>
                                <span class="text-text-secondary text-base font-normal ml-1">Dollars</span>
                            </span>
                        </div>
                    </div>

                    {{-- All Locations Section --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 transition-all duration-300 hover:shadow-md">
                        <h3 class="text-lg font-semibold text-text-primary mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            All Locations
                        </h3>
                        <ul class="space-y-4">
                            <li class="flex items-start text-sm text-text-secondary group transition-all duration-200 hover:bg-gray-50 p-2 -mx-2 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary mr-2 mt-1 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <span class="font-medium text-text-primary">North Miami Beach</span><br>
                                    3913 NE 163rd St<br>
                                    North Miami Beach, FL 33160
                                </div>
                            </li>
                            <li class="flex items-start text-sm text-text-secondary group transition-all duration-200 hover:bg-gray-50 p-2 -mx-2 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary mr-2 mt-1 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <span class="font-medium text-text-primary">East Rutherford</span><br>
                                    1 American Dream Way<br>
                                    #F225 East Rutherford, NJ 07073
                                </div>
                            </li>
                            <li class="flex items-start text-sm text-text-secondary group transition-all duration-200 hover:bg-gray-50 p-2 -mx-2 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary mr-2 mt-1 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <span class="font-medium text-text-primary">Sunrise</span><br>
                                    1760 Sawgrass Mills Circle<br>
                                    Sunrise, FL 33323-3912
                                </div>
                            </li>
                            <li class="flex items-start text-sm text-text-secondary group transition-all duration-200 hover:bg-gray-50 p-2 -mx-2 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary mr-2 mt-1 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <span class="font-medium text-text-primary">Coral Gables</span><br>
                                    4250 Salzedo Street, Suite 1425<br>
                                    Coral Gables, FL 33146
                                </div>
                            </li>
                            <li class="flex items-start text-sm text-text-secondary group transition-all duration-200 hover:bg-gray-50 p-2 -mx-2 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary mr-2 mt-1 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <span class="font-medium text-text-primary">Boca Raton</span><br>
                                    344 Plaza Real, Suite 1433<br>
                                    Boca Raton, FL 33432-3937
                                </div>
                            </li>
                        </ul>
                    </div>

                    {{-- Official Websites Section --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 transition-all duration-300 hover:shadow-md">
                        <h3 class="text-lg font-semibold text-text-primary mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            Official Websites
                        </h3>
                        <ul class="space-y-3">
                            <li class="group">
                                <a href="#" class="flex items-center p-2 -mx-2 rounded-md transition-colors duration-200 hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary mr-2 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    <span class="text-primary group-hover:text-primary-dark text-sm font-medium">Main Branch Website</span>
                                </a>
                            </li>
                            <li class="group">
                                <a href="#" class="flex items-center p-2 -mx-2 rounded-md transition-colors duration-200 hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary mr-2 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    <span class="text-primary group-hover:text-primary-dark text-sm font-medium">Community Portal</span>
                                </a>
                            </li>
                            <li class="group">
                                <a href="#" class="flex items-center p-2 -mx-2 rounded-md transition-colors duration-200 hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary mr-2 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    <span class="text-primary group-hover:text-primary-dark text-sm font-medium">Support & Help</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>