<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                {{-- Main Content Area (Our Place) --}}
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                        <h2 class="text-2xl font-semibold text-text-primary mb-6">Our Place</h2>

                        {{-- Adjusted grid columns for wider cards --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                            @if ($nextspaces->isEmpty())
                                <p class="text-text-secondary text-center col-span-full">No NextSpaces available yet. Please check back later!</p>
                            @else
                                @foreach ($nextspaces as $nextspace)
                                    <x-product-card
                                        imageUrl="{{ $nextspace->image ?? 'https://placehold.co/400x250/E0F2F7/00B4D8?text=NextSpace+Image' }}"
                                        title="{{ $nextspace->title }}"
                                        addressLine1="{{ $nextspace->address }}"
                                        addressLine2=""
                                        hours="{{ $nextspace->hours ?? 'N/A' }}"
                                        :timeSlots="$nextspace->time_slots ?? []"
                                        :detailUrl="route('nextspaces.show', ['id' => $nextspace->id])"
                                    >
                                        {{-- Conditional Admin Actions for Dashboard --}}
                                        @auth
                                            @if (Auth::user()->role === 'admin')
                                                <div class="flex justify-end gap-2 mt-4 pt-4 border-t border-gray-100">
                                                    <a href="{{ route('admin.nextspaces.edit', $nextspace->id) }}" class="text-primary hover:text-primary-dark text-sm font-medium">Edit</a>
                                                    <form action="{{ route('admin.nextspaces.destroy', $nextspace->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium" onclick="return confirm('Are you sure you want to delete this NextSpace?');">Delete</button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth
                                    </x-product-card>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Sidebar Area (remains the same) --}}
                <div class="lg:col-span-1 mt-8 lg:mt-0">
                    {{-- Your Savings Section --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-text-primary mb-4">Your Savings</h3>
                        <div class="text-4xl font-bold text-primary text-center">
                            20 <span class="text-text-secondary text-base font-normal">Dollars</span>
                        </div>
                    </div>

                    {{-- All Locations Section --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-text-primary mb-4">All Locations</h3>
                        <ul>
                            <li class="flex items-start mb-3 text-sm text-text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary mr-2 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    3913 NE 163rd St<br>
                                    North Miami Beach, FL 33160
                                </div>
                            </li>
                            <li class="flex items-start mb-3 text-sm text-text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary mr-2 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    1 American Dream Way<br>
                                    #F225 East Rutherford, NJ 07073
                                </div>
                            </li>
                            <li class="flex items-start mb-3 text-sm text-text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary mr-2 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    1760 Sawgrass Mills Circle<br>
                                    Sunrise, FL 33323-3912
                                </div>
                            </li>
                            <li class="flex items-start mb-3 text-sm text-text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary mr-2 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    4250 Salzedo Street, Suite 1425<br>
                                    Coral Gables, FL 33146
                                </div>
                            </li>
                            <li class="flex items-start text-sm text-text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary mr-2 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    344 Plaza Real, Suite 1433<br>
                                    Boca Raton, FL 33432-3937
                                </div>
                            </li>
                        </ul>
                    </div>

                    {{-- Official Websites Section --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-text-primary mb-4">Official Websites</h3>
                        <ul>
                            <li class="flex items-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                <a href="#" class="text-primary hover:underline text-sm">Main Branch Website</a>
                            </li>
                            <li class="flex items-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                <a href="#" class="text-primary hover:underline text-sm">Community Portal</a>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                <a href="#" class="text-primary hover:underline text-sm">Support & Help</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
