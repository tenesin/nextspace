<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-text-primary mb-6">Your Booking History</h2>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($bookings->isEmpty())
                    <p class="text-text-secondary text-center">You have no past bookings yet. Book a space to see your history!</p>
                @else
                    <div id="order-history-list" class="space-y-6">
                        @foreach ($bookings as $booking)
                            <div class="flex flex-col md:flex-row items-center bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200">
                                <img src="{{ $booking->nextspace_image_url }}" alt="{{ $booking->nextspace_title }}" class="w-24 h-24 object-cover rounded-md mr-4 mb-4 md:mb-0 flex-shrink-0">
                                <div class="flex-grow text-center md:text-left">
                                    <h3 class="text-lg font-semibold text-primary mb-1">{{ $booking->nextspace_title }}</h3>
                                    <p class="text-sm text-text-primary mb-1">{{ $booking->nextspace_address }}</p>
                                    {{-- Use null-safe operator ?-> --}}
                                    <p class="text-sm text-text-secondary">Booked: <span class="font-medium">{{ $booking->booked_time_slot }}</span> on <span class="font-medium">{{ $booking->booked_for?->format('M d, Y') ?? 'N/A' }}</span></p>
                                    <p class="text-sm text-text-secondary">Status: <span class="font-medium text-green-600">{{ $booking->status }}</span></p>
                                </div>
                                <div class="mt-4 md:mt-0 md:ml-auto flex flex-col items-center">
                                    @php
                                        // Ensure booking_for is not null before formatting for QR data
                                        $qrBookingDate = $booking->booked_for?->format('Y-m-d') ?? 'N/A';
                                        $qrData = "Booking ID: {$booking->booking_id}\nNextSpace: {$booking->nextspace_title}\nTime: {$booking->booked_time_slot}\nDate: {$qrBookingDate}";
                                        $qrCodeUrl = route('qr.generate', ['data' => urlencode($qrData)]);
                                    @endphp
                                    <img src="{{ $qrCodeUrl }}" alt="QR Code for {{ $booking->nextspace_title }}" class="w-24 h-24 mb-2 border border-gray-300 p-1 rounded-sm">
                                    <p class="text-xs text-gray-600 font-mono select-all">{{ $booking->booking_id }}</p>
                                    <a href="{{ route('history.show', ['booking_id' => $booking->booking_id]) }}" class="inline-block bg-primary text-text-light px-4 py-2 rounded-lg text-sm hover:bg-primary-dark transition duration-200 mt-2">View Details</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
