<x-app-layout>
    <div class="bg-gray-100 min-h-screen">

        <div class="relative w-full h-96 bg-cover bg-center" style="background-image: url('{{ $nextspace->image ?? 'https://placehold.co/1200x400/FFFFFF/00B4D8?text=NextSpace+Banner' }}');">
            <div class="absolute inset-0 bg-black opacity-30"></div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 -mt-24 relative z-10">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8">

                    <div class="text-sm text-text-secondary mb-4">
                        <a href="{{ route('dashboard') }}" class="hover:underline text-primary">Dashboard</a>
                        <span class="mx-1">/</span>
                        <span>{{ $nextspace->title }}</span>
                    </div>

                    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 pb-4 border-b border-gray-200">
                        <div>
                            <h1 class="text-4xl font-bold text-text-primary mb-2">{{ $nextspace->title }}</h1>
                            <div class="flex items-center text-lg text-text-secondary">
                                <span class="font-semibold mr-2">Rating:</span>
                                <span class="text-primary font-bold">{{ number_format($nextspace->rating, 1) ?? 'N/A' }}</span>
                                <span class="ml-1">({{ $nextspace->reviews_count ?? 0 }} reviews)</span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
                            @php
                                $safeTimeSlots = is_string($nextspace->time_slots) ? json_decode($nextspace->time_slots, true) : ($nextspace->time_slots ?? []);
                                $safeTimeSlots = is_array($safeTimeSlots) ? $safeTimeSlots : [];
                            @endphp
                            @foreach ($safeTimeSlots as $slot)
                                <button class="bg-primary text-text-light px-5 py-2 rounded-lg text-base font-semibold hover:bg-primary-dark transition duration-200">
                                    {{ $slot }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <p class="text-text-secondary leading-relaxed mb-8">{{ $nextspace->description }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <h3 class="text-xl font-semibold text-text-primary mb-4">Contact & Location</h3>
                            <div class="mb-4">
                                <p class="text-text-primary font-semibold">Address:</p>
                                <p class="text-text-secondary">{{ $nextspace->address }}</p>
                            </div>
                            <div class="mb-4">
                                <p class="text-text-primary font-semibold">Phone:</p>
                                <p class="text-primary">{{ $nextspace->phone }}</p>
                            </div>
                            <div class="mb-4">
                                <p class="text-text-primary font-semibold">Hours:</p>
                                <p class="text-text-secondary">{{ $nextspace->hours }}</p>
                            </div>
                        </div>

                        <div>
                            @php
                                $amenityIds = $nextspace->amenities ?? [];
                                $rawAmenityIds = is_string($amenityIds) ? json_decode($amenityIds, true) : $amenityIds;
                                $amenityIds = is_array($rawAmenityIds) ? $rawAmenityIds : [];
                                $displayAmenities = \App\Models\Amenity::whereIn('id', $amenityIds)->get();
                            @endphp
                            @if(!$displayAmenities->isEmpty())
                                <h3 class="text-xl font-semibold text-text-primary mb-4">Amenities</h3>
                                <div class="mb-6">
                                    <div class="flex flex-wrap gap-3">
                                        @foreach ($displayAmenities as $amenity)
                                            <span class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium">{{ $amenity->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <h3 class="text-xl font-semibold text-text-primary mb-4">Services Offered:</h3>
                            <ul class="space-y-2">
                                @php
                                    $serviceIds = $nextspace->services ?? [];
                                    $rawServiceIds = is_string($serviceIds) ? json_decode($serviceIds, true) : $serviceIds;
                                    $serviceIds = is_array($rawServiceIds) ? $rawServiceIds : [];

                                    $displayServices = \App\Models\Service::whereIn('id', $serviceIds)->get();
                                @endphp
                                @if(!$displayServices->isEmpty()) {{-- Added check here --}}
                                    @foreach ($displayServices as $serviceItem)
                                        <li class="flex justify-between items-center text-text-secondary border-b border-gray-100 pb-2 last:border-b-0 last:pb-0">
                                            <span>{{ $serviceItem->name }}</span>
                                            <span class="font-semibold text-primary">${{ number_format($serviceItem->price ?? 0, 2) }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-sm text-gray-500">No services listed for this space.</li> {{-- Message if no services --}}
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="text-center mt-10">
                        <a href="{{ route('payment.form', ['nextspace_id' => $nextspace->id]) }}" class="inline-block bg-primary text-text-light font-semibold py-4 px-10 rounded-lg text-lg hover:bg-primary-dark transition duration-300 shadow-md">
                            Book This Space Now
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
