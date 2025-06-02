<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6">

                {{-- Breadcrumbs --}}
                <div class="text-sm text-text-secondary mb-4">
                    <a href="{{ route('dashboard') }}" class="hover:underline text-primary">Dashboard</a>
                    <span class="mx-1">/</span>
                    <a href="{{ route('history.index') }}" class="hover:underline text-primary">My Bookings</a>
                    <span class="mx-1">/</span>
                    <span>{{ $booking->booking_id }}</span>
                </div>

                <h2 class="text-2xl font-semibold text-text-primary mb-6">Booking Details: {{ $booking->booking_id }}</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    {{-- Left Column: Image and Main Booking Info --}}
                    <div>
                        <img src="{{ $booking->nextspace_image_url }}" alt="{{ $booking->nextspace_title }}" class="w-full h-auto rounded-lg shadow-md mb-6">

                        <p class="text-lg font-semibold text-text-primary mb-2">{{ $booking->nextspace_title }}</p>
                        <p class="text-sm text-text-secondary mb-4">{{ $booking->nextspace_address }}</p>

                        <div class="mb-4">
                            <p class="text-text-primary font-semibold">Booked Date:</p>
                            <p class="text-text-secondary">{{ $booking->booking_date->format('F d, Y') }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-text-primary font-semibold">Booked Time Slot:</p>
                            <p class="text-primary font-semibold">{{ $booking->booked_time_slot }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-text-primary font-semibold">Total Price:</p>
                            <p class="text-primary font-bold text-xl">${{ number_format($booking->price, 2) }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-text-primary font-semibold">Status:</p>
                            <p class="text-green-600 font-semibold">{{ $booking->status }}</p>
                        </div>
                    </div>

                    {{-- Right Column: QR Code and Other Details --}}
                    <div class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <h3 class="text-xl font-semibold text-text-primary mb-4">Scan for Entry</h3>
                        @php
                            $qrData = "Booking ID: {$booking->booking_id}\nNextSpace: {$booking->nextspace_title}\nTime: {$booking->booked_time_slot}\nDate: {$booking->booking_date->format('Y-m-d')}";
                            $qrCodeUrl = route('qr.generate', ['data' => urlencode($qrData)]);
                        @endphp
                        <img src="{{ $qrCodeUrl }}" alt="QR Code for Booking {{ $booking->booking_id }}" class="w-48 h-48 mb-4 border border-gray-300 p-2 rounded-md">
                        <p class="text-sm text-gray-600 font-mono text-center break-all">Unique ID: <span class="font-semibold">{{ $booking->booking_id }}</span></p>
                        <p class="text-xs text-text-secondary mt-2 text-center">Present this QR code and ID upon arrival.</p>
                    </div>
                </div>

                {{-- Back button --}}
                <div class="text-center mt-8">
                    <a href="{{ route('history.index') }}" class="inline-block bg-gray-200 text-gray-800 font-semibold py-2 px-6 rounded-lg hover:bg-gray-300 transition duration-300">
                        Back to History
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>