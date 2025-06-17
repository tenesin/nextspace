{{-- filepath: /Users/ishaqyudha/Projects/nextspace/resources/views/nextspaces/show.blade.php --}}
<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        {{-- Compact Hero Section --}}
        <div
            class="relative w-full h-48 bg-cover bg-center"
            style="
                background-image: url('{{ $nextspace->image ?? 'https://placehold.co/1200x300/F8F9FA/6B7280?text=NextSpace' }}');
            "
        >
            <div class="absolute inset-0 bg-black/30"></div>

            {{-- Back button --}}
            <div class="absolute top-3 left-3 z-20">
                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-3 py-1.5 bg-white/90 backdrop-blur-sm text-gray-700 rounded-lg hover:bg-white transition-all text-sm shadow-sm"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 mr-1"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                    Back
                </a>
            </div>

            {{-- Price badge --}}
            @if ($nextspace->base_price)
                <div class="absolute top-3 right-3 z-20">
                    <div class="bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-lg shadow-sm">
                        <div class="text-base font-semibold text-gray-900">
                            Rp{{ number_format($nextspace->base_price, 0, ',', '.') }}
                        </div>
                        <div class="text-xs text-gray-600">Mulai dari</div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Main Content --}}
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-10 pb-6">
            <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
                {{-- Header --}}
                <div class="p-5 border-b border-gray-100">
                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4">
                        <div class="flex-1">
                            <h1 class="text-xl font-bold text-gray-900 mb-2">
                                {{ $nextspace->title }}
                            </h1>

                            {{-- Rating, Location, and Favorite --}}
                            <div class="flex flex-wrap items-center gap-3 mb-2">
                                @if ($nextspace->rating)
                                    <div class="flex items-center gap-1">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 text-blue-500"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                                            />
                                        </svg>
                                        <span class="text-gray-700 font-medium text-sm">
                                            {{ number_format($nextspace->rating, 1) }}
                                        </span>
                                        @if ($nextspace->reviews_count)
                                            <span class="text-gray-500 text-xs">
                                                ({{ $nextspace->reviews_count }})
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                {{-- Favorite Button --}}
                                <form
                                    method="POST"
                                    action="{{ route('favorites.toggle', $nextspace->id) }}"
                                >
                                    @csrf
                                    <button
                                        type="submit"
                                        class="text-gray-400 hover:text-blue-500 transition-colors"
                                    >
                                        @if ($isFavorited)
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="currentColor"
                                            >
                                                <path
                                                    d="M12 .587l3.69 7.568 8.31 1.205-6.005 5.854 1.416 8.281L12 18.896l-7.411 3.91 1.416-8.281-6.005-5.854 8.31-1.205L12 .587z"
                                                />
                                            </svg>
                                        @else
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.324 1.118l1.519 4.674c.3.921-.755 1.688-1.539 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.539-1.118l1.519-4.674a1 1 0 00-.324-1.118L2.285 9.102c-.783-.57-.381-1.81.588-1.81h4.914a1 1 0 00.95-.69l1.519-4.674z"
                                                />
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                            </div>

                            {{-- Address --}}
                            <div class="flex items-center gap-2 text-gray-600 text-sm">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-blue-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>
                                <span>{{ $nextspace->address }}</span>
                            </div>
                        </div>

                        {{-- Time Slots --}}
                        @if ($nextspace->timeSlots && $nextspace->timeSlots->count())
                            <div class="lg:w-96">
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <h3 class="text-sm font-medium text-blue-900 mb-3">
                                        Jam Tersedia
                                    </h3>
                                    <div class="grid grid-cols-4 gap-2">
                                        @foreach ($nextspace->timeSlots as $slot)
                                            <div
                                                class="text-center p-2 rounded-lg border text-xs font-medium transition-all {{
                                                    $slot->pivot->capacity <= 0 ? 'bg-gray-100 text-gray-400 border-gray-200 opacity-60' : 'bg-white text-blue-700 border-blue-200 hover:bg-blue-50 cursor-pointer'
                                                }}"
                                            >
                                                <div>{{ $slot->slot }}</div>
                                                <div
                                                    class="text-xs mt-1 {{ $slot->pivot->capacity <= 0 ? 'text-gray-400' : 'text-blue-600' }}"
                                                >
                                                    {{ $slot->pivot->capacity <= 0 ? 'Penuh' : $slot->pivot->capacity . ' tersisa' }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Description --}}
                @if ($nextspace->description)
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="text-base font-semibold text-gray-900 mb-2">Tentang</h2>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            {{ $nextspace->description }}
                        </p>
                    </div>
                @endif

                {{-- Main Grid --}}
                <div class="p-5">
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">
                        {{-- Contact Info --}}
                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="font-semibold text-gray-900 mb-3 text-sm">
                                    Kontak & Jam
                                </h3>

                                @if ($nextspace->phone)
                                    <div class="mb-3">
                                        <p class="text-xs text-gray-500 mb-1">Telepon</p>
                                        <a
                                            href="tel:{{ $nextspace->phone }}"
                                            class="text-blue-600 hover:text-blue-700 text-sm font-medium"
                                        >
                                            {{ $nextspace->phone }}
                                        </a>
                                    </div>
                                @endif

                                {{-- Hours --}}
                                <div>
                                    <p class="text-xs text-gray-500 mb-2">Jam Operasional</p>
                                    @if ($nextspace->hours && $nextspace->hours->count())
                                        <div class="text-xs text-gray-700 space-y-1">
                                            @foreach ($nextspace->hours as $hour)
                                                <div class="flex justify-between">
                                                    <span>
                                                        {{ $hour->day_type === 'mon-fri' ? 'Sen-Jum' : 'Sab-Min' }}
                                                    </span>
                                                    <span class="font-medium">
                                                        {{ $hour->open_time }}-{{ $hour->close_time }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-xs text-gray-500">Tidak tersedia</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Amenities & Services --}}
                        <div class="lg:col-span-3 space-y-4">
                            {{-- Amenities --}}
                            @if ($nextspace->amenities && $nextspace->amenities->count())
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-3 text-sm">
                                        Fasilitas
                                    </h3>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                        @foreach ($nextspace->amenities as $amenity)
                                            <div
                                                class="flex items-center gap-2 p-2 bg-blue-50 rounded-lg text-xs"
                                            >
                                                <div
                                                    class="w-1.5 h-1.5 bg-blue-500 rounded-full"
                                                ></div>
                                                <span class="text-blue-800">
                                                    {{ $amenity->name }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Services --}}
                            @if ($nextspace->services && $nextspace->services->count())
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-3 text-sm">
                                        Layanan & Harga
                                    </h3>
                                    <div
                                        class="bg-white rounded-lg border border-gray-200 divide-y divide-gray-100"
                                    >
                                        @foreach ($nextspace->services as $serviceItem)
                                            <div class="flex justify-between items-center p-3">
                                                <span class="text-gray-700 text-sm">
                                                    {{ $serviceItem->name }}
                                                </span>
                                                <span class="font-semibold text-blue-600 text-sm">
                                                    Rp{{ number_format($serviceItem->price ?? 0, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Reviews Section --}}
                @php
                    $avgRating = $nextspace->reviews->avg('rating');
                    $reviewCount = $nextspace->reviews->count();
                @endphp

                @if ($reviewCount > 0)
                    <div class="px-5 py-4 border-t border-gray-100">
                        <div class="flex items-center gap-3 mb-4">
                            <h3 class="font-semibold text-gray-900 text-sm">Ulasan</h3>
                            <div class="flex items-center gap-2">
                                <span class="text-blue-500 text-sm">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= round($avgRating))
                                            ★
                                        @else
                                                ☆
                                        @endif
                                    @endfor
                                </span>
                                <span class="text-sm text-gray-700 font-medium">
                                    {{ number_format($avgRating, 1) }}/5
                                </span>
                                <span class="text-xs text-gray-500">
                                    ({{ $reviewCount }} ulasan)
                                </span>
                            </div>
                        </div>

                        <div
                            class="space-y-3 max-h-48 overflow-y-scroll border border-gray-200 rounded-lg p-3 bg-gray-50"
                        >
                            @foreach ($nextspace->reviews as $review)
                                <div
                                    class="border-b border-gray-100 pb-3 last:border-b-0 bg-white rounded p-2"
                                >
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-medium text-gray-800 text-sm">
                                            {{ $review->user->name ?? 'Anonim' }}
                                        </span>
                                        <span class="text-blue-500 text-xs">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    ★
                                                @else
                                                        ☆
                                                @endif
                                            @endfor
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ $review->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                    <div class="text-gray-600 text-xs leading-relaxed">
                                        {{ $review->comment }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Booking Section --}}
                <div class="bg-blue-50 p-5">
                    <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
                        <div class="text-center sm:text-left">
                            <h3 class="text-base font-semibold text-blue-900 mb-1">
                                Siap untuk memesan?
                            </h3>
                            <p class="text-blue-700 text-sm">
                                Pesan tempat Anda dan nikmati ruang ini
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 items-center">
                            @if ($nextspace->base_price)
                                <div class="text-center">
                                    <div class="text-lg font-bold text-blue-900">
                                        Rp{{ number_format($nextspace->base_price, 0, ',', '.') }}
                                    </div>
                                    <div class="text-xs text-blue-600">harga mulai</div>
                                </div>
                            @endif

                            <a
                                href="{{ route('payment.form', ['nextspace_id' => $nextspace->id]) }}"
                                class="inline-flex items-center justify-center bg-blue-600 text-white font-medium py-2.5 px-5 rounded-lg hover:bg-blue-700 transition-colors text-sm shadow-sm"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 mr-2"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z"
                                    />
                                </svg>
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
