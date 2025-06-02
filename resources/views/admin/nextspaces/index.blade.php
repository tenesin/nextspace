<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-text-primary">Manage NextSpaces</h2>
                    <a href="{{ route('admin.nextspaces.create') }}" class="bg-primary text-text-light px-4 py-2 rounded-lg hover:bg-primary-dark transition duration-200">Create New NextSpace</a>
                </div>

                @if (session('success'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($nextspaces->isEmpty())
                    <p class="text-text-secondary text-center">No NextSpaces found. Create one!</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($nextspaces as $nextspace)
                            {{-- Changed to x-admin-product-card and added nextspaceId prop --}}
                            <x-admin-product-card
                                imageUrl="{{ $nextspace->image ?? 'https://placehold.co/400x250/E0F2F7/00B4D8?text=NextSpace+Image' }}"
                                title="{{ $nextspace->title }}"
                                addressLine1="{{ $nextspace->address }}"
                                addressLine2=""
                                hours="{{ $nextspace->hours ?? 'N/A' }}"
                                :timeSlots="$nextspace->time_slots ?? []"
                                :detailUrl="route('nextspaces.show', ['id' => $nextspace->id])"
                                :nextspaceId="$nextspace->id" {{-- Pass the nextspace ID here --}}
                            >
                                @php
                                    $rawAmenityIds = $nextspace->amenities ?? [];
                                    $amenityIds = is_string($rawAmenityIds) ? json_decode($rawAmenityIds, true) : $rawAmenityIds;
                                    $amenityIds = is_array($amenityIds) ? $amenityIds : [];
                                    $displayAmenities = \App\Models\Amenity::whereIn('id', $amenityIds)->pluck('name')->implode(', ');

                                    $rawServiceIds = $nextspace->services ?? [];
                                    $serviceIds = is_string($rawServiceIds) ? json_decode($rawServiceIds, true) : $rawServiceIds;
                                    $serviceIds = is_array($serviceIds) ? $serviceIds : [];
                                    $displayServices = \App\Models\Service::whereIn('id', $serviceIds)->pluck('name')->implode(', ');
                                @endphp

                                @if(!empty($displayAmenities))
                                    <div class="mt-2 text-sm text-gray-600">
                                        Amenities: {{ $displayAmenities }}
                                    </div>
                                @endif
                                @if(!empty($displayServices))
                                    <div class="mt-1 text-sm text-gray-600">
                                        Services: {{ $displayServices }}
                                    </div>
                                @endif
                                {{-- Admin edit/delete buttons are now inside x-admin-product-card itself --}}
                                {{-- So, this div is removed from here --}}
                            </x-admin-product-card>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
