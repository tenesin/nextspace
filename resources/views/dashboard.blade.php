<x-app-layout>
    <div class="py-6 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-4 lg:gap-6">
                {{-- Main Content Area --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h1 class="text-xl font-semibold text-gray-900">Available Spaces</h1>
                            <span class="text-sm text-gray-500 bg-blue-50 px-2 py-1 rounded">
                                {{ $nextspaces->count() }} spaces
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                            @if ($nextspaces->isEmpty())
                                <div
                                    class="col-span-full py-8 text-center bg-gray-50 rounded-lg border-2 border-dashed border-gray-200"
                                >
                                    <div class="w-12 h-12 mx-auto mb-3 text-gray-300">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                                            />
                                        </svg>
                                    </div>
                                    <p class="text-gray-500">No spaces available</p>
                                </div>
                            @else
                                @foreach ($nextspaces as $nextspace)
                                    @php
                                        $rawAmenityIds = $nextspace->amenities ?? [];
                                        $amenityIds = is_string($rawAmenityIds) ? json_decode($rawAmenityIds, true) : $rawAmenityIds;
                                        $amenityIds = is_array($amenityIds) ? $amenityIds : [];
                                        $displayAmenities = \App\Models\Amenity::whereIn('id', $amenityIds)
                                            ->pluck('name')
                                            ->take(3)
                                            ->implode(', ');

                                        $rawServiceIds = $nextspace->services ?? [];
                                        $serviceIds = is_string($rawServiceIds) ? json_decode($rawServiceIds, true) : $rawServiceIds;
                                        $serviceIds = is_array($serviceIds) ? $serviceIds : [];
                                        $displayServices = \App\Models\Service::whereIn('id', $serviceIds)
                                            ->pluck('name')
                                            ->take(3)
                                            ->implode(', ');

                                        $displayTimeSlots = $nextspace->timeSlots
                                            ->pluck('slot')
                                            ->take(3)
                                            ->toArray();
                                        $displayHours = $nextspace->hours ?? 'N/A';
                                    @endphp

                                    <div
                                        class="bg-white border border-gray-200 rounded-lg hover:border-blue-300 hover:shadow-md transition-all duration-200"
                                    >
                                        {{-- Image --}}
                                        <div
                                            class="aspect-video bg-gray-100 rounded-t-lg overflow-hidden"
                                        >
                                            <img
                                                src="{{ $nextspace->image ?? 'https://placehold.co/400x225/F3F4F6/6B7280?text=NextSpace' }}"
                                                alt="{{ $nextspace->title }}"
                                                class="w-full h-full object-cover"
                                            />
                                        </div>

                                        {{-- Content --}}
                                        <div class="p-3">
                                            <h3 class="font-medium text-gray-900 mb-1 truncate">
                                                {{ $nextspace->title }}
                                            </h3>
                                            <p class="text-sm text-gray-600 mb-2 truncate">
                                                {{ $nextspace->address }}
                                            </p>

                                            {{-- Compact Info --}}
                                            <div class="space-y-1 text-xs text-gray-500 mb-3">
                                                @if (! empty($displayAmenities))
                                                    <div class="flex items-center gap-1">
                                                        <span class="w-3 h-3 text-blue-500">✓</span>
                                                        <span class="truncate">
                                                            {{ $displayAmenities }}
                                                        </span>
                                                    </div>
                                                @endif

                                                @if (! empty($displayServices))
                                                    <div class="flex items-center gap-1">
                                                        <span class="w-3 h-3 text-blue-500">
                                                            ⚡
                                                        </span>
                                                        <span class="truncate">
                                                            {{ $displayServices }}
                                                        </span>
                                                    </div>
                                                @endif

                                                @if (! empty($displayTimeSlots))
                                                    <div class="flex items-center gap-1">
                                                        <span class="w-3 h-3 text-blue-500">
                                                            🕒
                                                        </span>
                                                        <span class="truncate">
                                                            {{ implode(', ', $displayTimeSlots) }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Actions --}}
                                            <div class="flex gap-2">
                                                <a
                                                    href="{{ route('nextspaces.show', ['id' => $nextspace->id]) }}"
                                                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-3 rounded text-center transition-colors"
                                                >
                                                    View Details
                                                </a>

                                                @auth
                                                    @if (Auth::user()->role === 'admin')
                                                        <a
                                                            href="{{ route('admin.nextspaces.edit', $nextspace->id) }}"
                                                            class="text-blue-600 hover:text-blue-800 text-sm p-2"
                                                        >
                                                            <svg
                                                                class="w-4 h-4"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                                />
                                                            </svg>
                                                        </a>
                                                        <form
                                                            action="{{ route('admin.nextspaces.destroy', $nextspace->id) }}"
                                                            method="POST"
                                                            class="inline"
                                                        >
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                type="submit"
                                                                class="text-red-500 hover:text-red-700 text-sm p-2"
                                                                onclick="return confirm('Delete this space?');"
                                                            >
                                                                <svg
                                                                    class="w-4 h-4"
                                                                    fill="none"
                                                                    stroke="currentColor"
                                                                    viewBox="0 0 24 24"
                                                                >
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                                    />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Pagination --}}
                                <div class="col-span-full mt-4">
                                    {{ $nextspaces->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1 space-y-4">
                    {{-- My Bookings --}}
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <h3 class="font-medium text-gray-900 mb-3 flex items-center">
                            <span class="w-4 h-4 mr-2 text-blue-600">📋</span>
                            My Bookings
                        </h3>
                        @php
                            $bookingCount = Auth::user()
                                ->bookings()
                                ->count();
                            $lastBooking = Auth::user()
                                ->bookings()
                                ->latest()
                                ->first();
                        @endphp

                        <div class="text-center py-3">
                            <div class="text-2xl font-bold text-blue-600">{{ $bookingCount }}</div>
                            <div class="text-sm text-gray-500">Total Bookings</div>
                            @if ($lastBooking)
                                <div class="text-xs text-gray-400 mt-1">
                                    Last: {{ $lastBooking->created_at->format('M d, Y') }}
                                </div>
                            @endif
                        </div>
                        <a
                            href="{{ route('history.index') }}"
                            class="block w-full bg-blue-50 hover:bg-blue-100 text-blue-700 text-sm font-medium py-2 px-3 rounded text-center transition-colors"
                        >
                            View History
                        </a>
                    </div>

                    {{-- Locations --}}
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <h3 class="font-medium text-gray-900 mb-3 flex items-center">
                            <span class="w-4 h-4 mr-2 text-blue-600">📍</span>
                            Locations
                        </h3>
                        <div class="space-y-2 text-sm">
                            <div class="p-2 bg-gray-50 rounded text-gray-700">
                                <div class="font-medium">Historica Coffee & Pastry</div>
                                <div class="text-xs text-gray-500">Jl. Sumatera No.40, Gubeng</div>
                            </div>
                            <div class="p-2 bg-gray-50 rounded text-gray-700">
                                <div class="font-medium">Caturra Espresso</div>
                                <div class="text-xs text-gray-500">
                                    Jl. Anjasmoro No.32, Sawahan
                                </div>
                            </div>
                            <div class="p-2 bg-gray-50 rounded text-gray-700">
                                <div class="font-medium">Blackbarn Coffee</div>
                                <div class="text-xs text-gray-500">Jl. Untung Suropati No.79</div>
                            </div>
                            <div class="p-2 bg-gray-50 rounded text-gray-700">
                                <div class="font-medium">One Pose Cafe</div>
                                <div class="text-xs text-gray-500">Jl. Puncak Permai II No.22</div>
                            </div>
                            <div class="p-2 bg-gray-50 rounded text-gray-700">
                                <div class="font-medium">Carpentier Kitchen</div>
                                <div class="text-xs text-gray-500">Jl. Untung Suropati No.83</div>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Links --}}
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <h3 class="font-medium text-gray-900 mb-3 flex items-center">
                            <span class="w-4 h-4 mr-2 text-blue-600">🔗</span>
                            Quick Links
                        </h3>
                        <div class="space-y-2">
                            <a
                                href="#"
                                class="block text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 p-2 rounded transition-colors"
                            >
                                Main Website
                            </a>
                            <a
                                href="#"
                                class="block text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 p-2 rounded transition-colors"
                            >
                                Community Portal
                            </a>
                            <a
                                href="#"
                                class="block text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 p-2 rounded transition-colors"
                            >
                                Support & Help
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
