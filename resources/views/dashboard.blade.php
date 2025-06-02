<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                {{-- Main Content Area (Our Place) --}}
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                        <h2 class="text-2xl font-semibold text-text-primary mb-6">Our Place</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {{-- Nextspace Card 1 --}}
                            <x-product-card
                                imageUrl="https://placehold.co/400x250/E0F2F7/00B4D8?text=NextSpace+Image"
                                title="The Creative Hub - North Miami"
                                addressLine1="3933 NE 163rd St"
                                addressLine2="North Miami Beach, FL 33160"
                                hours="Mon-Fri: 8:00 AM - 9:00 PM"
                                :timeSlots="['09:30', '10:15', '11:15']"
                                :detailUrl="route('nextspaces.show', ['id' => 1])" {{-- UPDATED ROUTE --}}
                            />

                            {{-- Nextspace Card 2 --}}
                            <x-product-card
                                imageUrl="https://placehold.co/400x250/E0F2F7/00B4D8?text=NextSpace+Image"
                                title="Innovation Lounge - Merrick Park"
                                addressLine1="4250 Salzedo Street,"
                                addressLine2="Suite 1425 Coral Gables, FL 33146"
                                hours="Mon-Sat: 9:00 AM - 10:00 PM"
                                :timeSlots="['09:30', '10:15', '11:15']"
                                :detailUrl="route('nextspaces.show', ['id' => 2])" {{-- UPDATED ROUTE --}}
                            />

                            {{-- Nextspace Card 3 --}}
                            <x-product-card
                                imageUrl="https://placehold.co/400x250/E0F2F7/00B4D8?text=NextSpace+Image"
                                title="Event Venue - Coral Gables"
                                addressLine1="360 San Lorenzo Avenue,"
                                addressLine2="Suite 1430 Coral Gables, FL 33146"
                                hours="By Appointment"
                                :timeSlots="['09:30', '10:15', '11:15']"
                                :detailUrl="route('nextspaces.show', ['id' => 3])" {{-- UPDATED ROUTE --}}
                            />

                            {{-- Nextspace Card 4 --}}
                            <x-product-card
                                imageUrl="https://placehold.co/400x250/E0F2F7/00B4D8?text=NextSpace+Image"
                                title="Digital Nomad Hub - American Dream"
                                addressLine1="1 American Dream Way,"
                                addressLine2="#F225 East Rutherford, NJ 07073"
                                hours="Mon-Sun: 10:00 AM - 9:00 PM"
                                :timeSlots="['09:30', '10:15', '11:15']"
                                :detailUrl="route('nextspaces.show', ['id' => 4])" {{-- UPDATED ROUTE --}}
                            />

                            {{-- Nextspace Card 5 --}}
                            <x-product-card
                                imageUrl="https://placehold.co/400x250/E0F2F7/00B4D8?text=NextSpace+Image"
                                title="Shared Workspace - Sawgrass Mills"
                                addressLine1="1760 Sawgrass Mills Circle"
                                addressLine2="Sunrise, FL 33323-3912"
                                hours="Mon-Sun: 11:00 AM - 10:00 PM"
                                :timeSlots="['09:30', '10:15', '11:15']"
                                :detailUrl="route('nextspaces.show', ['id' => 5])" {{-- UPDATED ROUTE --}}
                            />

                            {{-- Nextspace Card 6 --}}
                            <x-product-card
                                imageUrl="https://placehold.co/400x250/E0F2F7/00B4D8?text=NextSpace+Image"
                                title="Executive Suites - Boca Raton"
                                addressLine1="344 Plaza Real, Suite 1433"
                                addressLine2="Boca Raton, FL 33432-3937"
                                hours="Mon-Fri: 9:00 AM - 5:00 PM"
                                :timeSlots="['09:30', '10:15', '11:15']"
                                :detailUrl="route('nextspaces.show', ['id' => 6])" {{-- UPDATED ROUTE --}}
                            />
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