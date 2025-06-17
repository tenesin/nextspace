<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header Section --}}
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-1">Riwayat Pemesanan</h2>
                        <p class="text-gray-600 text-sm">Lacak semua reservasi NextSpace Anda</p>
                    </div>
                    
                    {{-- Compact Stats --}}
                    <div class="mt-4 md:mt-0 flex gap-4">
                        <div class="bg-blue-50 rounded-lg px-4 py-3 text-center">
                            <div class="text-xl font-bold text-blue-600">{{ $bookings->count() }}</div>
                            <div class="text-xs text-gray-600">Total</div>
                        </div>
                        @php
                            $totalSpent = $bookings->sum('price');
                        @endphp
                        <div class="bg-blue-50 rounded-lg px-4 py-3 text-center">
                            <div class="text-xl font-bold text-blue-600">Rp{{ number_format($totalSpent, 0, ',', '.') }}</div>
                            <div class="text-xs text-gray-600">Pengeluaran</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status Messages --}}
            @if (session('status'))
                <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-center">
                        <svg class="h-4 w-4 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-blue-800 text-sm font-medium">{{ session('status') }}</span>
                    </div>
                </div>
            @endif

            {{-- Main Content --}}
            <div class="bg-white shadow-sm rounded-lg">
                @if ($bookings->isEmpty())
                    {{-- Empty State --}}
                    <div class="text-center py-16">
                        <svg class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada pemesanan</h3>
                        <p class="text-gray-600 mb-6 text-sm">Mulai jelajahi ruang kerja amazing kami!</p>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Jelajahi Ruang
                        </a>
                    </div>
                @else
                    {{-- Filter Section --}}
                    <div class="p-4 border-b border-gray-200 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                        <form method="GET" action="{{ route('history.index') }}" class="flex items-center gap-2">
    <span class="text-sm text-gray-600">Urutkan:</span>
    <select name="sort" class="text-sm border border-gray-300 rounded-md px-2 py-1 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
        onchange="this.form.submit()">
        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
        <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>Harga Tertinggi</option>
        <option value="lowest" {{ request('sort') == 'lowest' ? 'selected' : '' }}>Harga Terendah</option>
    </select>
</form>
                        <span class="text-sm text-gray-600">{{ $bookings->count() }} pemesanan</span>
                    </div>

                    {{-- Compact Bookings List --}}
                    <div class="divide-y divide-gray-200">
                        @foreach ($bookings as $booking)
                            <div class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex gap-4">
                                    
                                    {{-- Space Image --}}
                                    <div class="relative flex-shrink-0">
                                        <img src="{{ $booking->nextspace_image_url ?? 'https://placehold.co/80x80/E3F2FD/1976D2?text=Space' }}" 
                                             alt="{{ $booking->nextspace_title }}" 
                                             class="w-16 h-16 object-cover rounded-lg">
                                        
                                        {{-- Compact Status Badge --}}
                                        @php
                                            $statusColors = [
                                                'confirmed' => 'bg-blue-500',
                                                'pending' => 'bg-yellow-500',
                                                'cancelled' => 'bg-gray-500',
                                                'completed' => 'bg-green-500'
                                            ];
                                            $statusColor = $statusColors[strtolower($booking->status)] ?? 'bg-gray-500';
                                        @endphp
                                        <span class="{{ $statusColor }} absolute -top-1 -right-1 w-3 h-3 rounded-full border-2 border-white"></span>
                                    </div>

                                    {{-- Booking Info --}}
                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2">
                                            <div class="min-w-0 flex-1">
                                                <h3 class="font-semibold text-gray-900 text-sm truncate">{{ $booking->nextspace_title }}</h3>
                                                <div class="flex items-center text-xs text-gray-600 mt-1">
                                                    <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                                    </svg>
                                                    <span class="truncate">{{ $booking->nextspace_address }}</span>
                                                </div>
                                                
                                                {{-- Compact Details --}}
                                                <div class="flex flex-wrap gap-3 mt-2 text-xs text-gray-600">
                                                    <div class="flex items-center">
                                                        <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z" />
                                                        </svg>
                                                        {{ $booking->booked_for?->format('d M Y') ?? 'N/A' }}
                                                    </div>
                                                    <div class="flex items-center">
                                                        <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ $booking->booked_time_slot }}
                                                    </div>
                                                    <div class="flex items-center">
                                                        <span class="bg-gray-200 px-2 py-0.5 rounded text-xs font-mono">{{ $booking->booking_id }}</span>
                                                    </div>
                                                </div>

                                                {{-- Services (Compact) --}}
                                                @php
                                                    $safeSelectedServices = $booking->selected_services_details ?? [];
                                                    if (is_string($safeSelectedServices)) {
                                                        $decoded = json_decode($safeSelectedServices, true);
                                                        $safeSelectedServices = is_array($decoded) ? $decoded : [];
                                                    }
                                                    $safeSelectedServices = is_array($safeSelectedServices) ? $safeSelectedServices : [];
                                                @endphp
                                                
                                                @if(!empty($safeSelectedServices))
                                                    <div class="mt-2">
                                                        <div class="flex flex-wrap gap-1">
                                                            @foreach(array_slice($safeSelectedServices, 0, 3) as $service)
                                                                <span class="inline-flex items-center px-2 py-0.5 bg-blue-50 text-blue-700 rounded text-xs">
                                                                    {{ $service['name'] }}
                                                                </span>
                                                            @endforeach
                                                            @if(count($safeSelectedServices) > 3)
                                                                <span class="text-xs text-gray-500">+{{ count($safeSelectedServices) - 3 }} lainnya</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Price and Actions --}}
                                            <div class="flex flex-col sm:items-end gap-2">
                                                <div class="text-right">
                                                    <div class="text-lg font-bold text-blue-600">
                                                        Rp{{ number_format($booking->price ?? 0, 0, ',', '.') }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 capitalize">{{ $booking->status }}</div>
                                                </div>

                                                {{-- Compact Actions --}}
                                                <div class="flex flex-wrap gap-1">
                                                    <a href="{{ route('history.show', ['booking_id' => $booking->booking_id]) }}" 
                                                       class="inline-flex items-center bg-blue-600 text-white px-3 py-1.5 rounded text-xs font-medium hover:bg-blue-700 transition-colors">
                                                        <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                        Detail
                                                    </a>

                                                    @if(strtolower($booking->status) === 'confirmed')
                                                        <a href="{{ route('history.invoice', ['booking_id' => $booking->booking_id]) }}"
                                                           class="inline-flex items-center bg-blue-100 text-blue-700 px-3 py-1.5 rounded text-xs font-medium hover:bg-blue-200 transition-colors">
                                                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                            </svg>
                                                            Invoice
                                                        </a>

                                                        <button onclick="navigator.clipboard.writeText('{{ $booking->booking_id }}'); 
                                                                       this.innerHTML='<svg class=\'h-3 w-3 mr-1\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M5 13l4 4L19 7\' /></svg>Disalin'; 
                                                                       setTimeout(() => this.innerHTML='<svg class=\'h-3 w-3 mr-1\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M8 16H6a2 2 0 01-2-2V6a2  2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z\' /></svg>Salin', 2000)"
                                                            class="inline-flex items-center bg-gray-100 text-gray-700 px-3 py-1.5 rounded text-xs font-medium hover:bg-gray-200 transition-colors">
                                                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                            </svg>
                                                            Salin
                                                        </button>
                                                    @endif

                                                    @if(in_array(strtolower($booking->status), ['cancelled', 'canceled', 'checked in']))
                                                        <form method="POST" action="{{ route('history.remove', $booking->id) }}" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                onclick="return confirm('Yakin ingin menghapus booking ini dari riwayat?');"
                                                                class="inline-flex items-center bg-gray-100 text-gray-600 px-3 py-1.5 rounded text-xs font-medium hover:bg-red-50 hover:text-red-600 transition-colors">
                                                                <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if(method_exists($bookings, 'links'))
                        <div class="p-4 border-t border-gray-200">
                            {{ $bookings->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>