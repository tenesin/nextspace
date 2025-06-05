<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Header Section --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Your Booking History</h2>
                        <p class="text-gray-600">Track all your NextSpace reservations and bookings</p>
                    </div>
                    
                    {{-- Summary Stats --}}
                    <div class="mt-4 md:mt-0 flex flex-col md:flex-row gap-4">
                        <div class="bg-primary/10 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-primary">{{ $bookings->count() }}</div>
                            <div class="text-sm text-gray-600">Total Bookings</div>
                        </div>
                        @php
                            $totalSpent = $bookings->sum('price');
                        @endphp
                        <div class="bg-green-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-green-600">${{ number_format($totalSpent, 2) }}</div>
                            <div class="text-sm text-gray-600">Total Spent</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status Messages --}}
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-green-800 font-medium">{{ session('status') }}</span>
                    </div>
                </div>
            @endif

            {{-- Main Content --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($bookings->isEmpty())
                    {{-- Empty State --}}
                    <div class="text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No bookings yet</h3>
                        <p class="text-gray-600 mb-6">You haven't made any bookings yet. Start exploring our amazing spaces!</p>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Browse Spaces
                        </a>
                    </div>
                @else
                    {{-- Filter/Sort Options --}}
                    <div class="mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-600">Sort by:</span>
                            <select class="text-sm border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-primary/20">
                                <option>Most Recent</option>
                                <option>Oldest First</option>
                                <option>Highest Amount</option>
                                <option>Lowest Amount</option>
                            </select>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-600">Showing {{ $bookings->count() }} bookings</span>
                        </div>
                    </div>

                    {{-- Bookings List --}}
                    <div id="order-history-list" class="space-y-4">
                        @foreach ($bookings as $booking)
                            <div class="group bg-gray-50 hover:bg-gray-100 transition-colors duration-200 rounded-xl border border-gray-200 hover:border-primary/30 overflow-hidden">
                                <div class="p-6">
                                    <div class="flex flex-col lg:flex-row gap-6">
                                        
                                        {{-- Space Image and Basic Info --}}
                                        <div class="flex flex-col md:flex-row gap-4 flex-1">
                                            <div class="relative flex-shrink-0">
                                                <img src="{{ $booking->nextspace_image_url ?? 'https://placehold.co/120x120/E0F2F7/00B4D8?text=Space' }}" 
                                                     alt="{{ $booking->nextspace_title }}" 
                                                     class="w-24 h-24 md:w-28 md:h-28 object-cover rounded-lg shadow-sm">
                                                
                                                {{-- Status Badge --}}
                                                <div class="absolute -top-2 -right-2">
                                                    @php
                                                        $statusColors = [
                                                            'confirmed' => 'bg-green-500',
                                                            'pending' => 'bg-yellow-500',
                                                            'cancelled' => 'bg-red-500',
                                                            'completed' => 'bg-blue-500'
                                                        ];
                                                        $statusColor = $statusColors[strtolower($booking->status)] ?? 'bg-gray-500';
                                                    @endphp
                                                    <span class="{{ $statusColor }} text-white text-xs px-2 py-1 rounded-full font-semibold capitalize">
                                                        {{ $booking->status }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-2 mb-3">
                                                    <div>
                                                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary transition-colors">
                                                            {{ $booking->nextspace_title }}
                                                        </h3>
                                                        <div class="flex items-center text-gray-600 mt-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            </svg>
                                                            <span class="text-sm truncate">{{ $booking->nextspace_address }}</span>
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- Total Amount --}}
                                                    <div class="text-right">
                                                        <div class="text-2xl font-bold text-primary">
                                                            ${{ number_format($booking->price ?? 0, 2) }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">Total Cost</div>
                                                    </div>
                                                </div>

                                                {{-- Booking Details --}}
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                    <div class="flex items-center text-sm text-gray-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z" />
                                                        </svg>
                                                        <span class="font-medium">{{ $booking->booked_for?->format('M d, Y') ?? 'N/A' }}</span>
                                                    </div>
                                                    
                                                    <div class="flex items-center text-sm text-gray-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span class="font-medium">{{ $booking->booked_time_slot }}</span>
                                                    </div>
                                                </div>

                                                {{-- Services --}}
                                                @php
                                                    $safeSelectedServices = $booking->selected_services_details ?? [];
                                                    if (is_string($safeSelectedServices)) {
                                                        $decoded = json_decode($safeSelectedServices, true);
                                                        $safeSelectedServices = is_array($decoded) ? $decoded : [];
                                                    }
                                                    $safeSelectedServices = is_array($safeSelectedServices) ? $safeSelectedServices : [];
                                                @endphp
                                                
                                                @if(!empty($safeSelectedServices))
                                                    <div class="mb-4">
                                                        <h4 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                            </svg>
                                                            Additional Services
                                                        </h4>
                                                        <div class="flex flex-wrap gap-2">
                                                            @foreach($safeSelectedServices as $service)
                                                                <span class="inline-flex items-center px-3 py-1 bg-white border border-gray-200 rounded-full text-xs">
                                                                    <span class="font-medium">{{ $service['name'] }}</span>
                                                                    <span class="ml-1 text-primary font-semibold">${{ number_format($service['price'], 2) }}</span>
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- Booking ID --}}
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center text-xs text-gray-500">
                                                        <span class="mr-2">Booking ID:</span>
                                                        <code class="bg-gray-200 px-2 py-1 rounded font-mono select-all">{{ $booking->booking_id }}</code>
                                                    </div>
                                                    
                                                    <div class="text-xs text-gray-500">
                                                        Booked on {{ $booking->created_at?->format('M d, Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- QR Code and Actions --}}
                                        <div class="flex flex-col items-center justify-center lg:w-32 gap-3">
                                            @php
                                                $qrBookingDate = $booking->booked_for?->format('Y-m-d') ?? 'N/A';
                                                $qrData = "Booking ID: {$booking->booking_id}\nNextSpace: {$booking->nextspace_title}\nTime: {$booking->booked_time_slot}\nDate: {$qrBookingDate}";
                                                $qrCodeUrl = route('qr.generate', ['data' => urlencode($qrData)]);
                                            @endphp
                                            
                                            <div class="relative group/qr">
                                                <img src="{{ $qrCodeUrl }}" 
                                                     alt="QR Code for {{ $booking->nextspace_title }}" 
                                                     class="w-20 h-20 border-2 border-gray-200 rounded-lg p-1 bg-white group-hover/qr:border-primary transition-colors">
                                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover/qr:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                                    <span class="text-white text-xs font-medium">Scan Me</span>
                                                </div>
                                            </div>

                                            <div class="flex flex-col gap-2 w-full">
                                                <a href="{{ route('history.show', ['booking_id' => $booking->booking_id]) }}" 
                                                   class="inline-flex items-center justify-center bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-dark transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Details
                                                </a>
                                                
                                                @if(strtolower($booking->status) === 'confirmed')
                                                    <button class="inline-flex items-center justify-center bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                                                        </svg>
                                                        Share
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination if needed --}}
                    @if(method_exists($bookings, 'links'))
                        <div class="mt-8">
                            {{ $bookings->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>