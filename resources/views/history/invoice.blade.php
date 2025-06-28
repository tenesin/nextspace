{{-- filepath: resources/views/history/invoice.blade.php --}}
<x-app-layout>
    <div class="min-h-screen flex flex-col bg-white">
        <div class="flex-1 max-w-2xl mx-auto py-10 px-4">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Invoice</h1>
                <p class="text-gray-600">Invoice #: {{ $booking->booking_id }}</p>
                <p class="text-gray-600">Date: {{ $booking->created_at->format('d M Y') }}</p>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Customer</h2>
                <div class="text-gray-700">
                    <div>{{ $booking->user->name ?? '-' }}</div>
                    <div>{{ $booking->user->email ?? '-' }}</div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Space Details</h2>
                <div class="text-gray-700">
                    <div>{{ $booking->nextspace_title }}</div>
                    <div>{{ $booking->nextspace_address }}</div>
                    <div>Time Slot: {{ $booking->booked_time_slot }}</div>
                    <div>Date: {{ $booking->booked_for->format('d M Y') }}</div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Payment</h2>
                <div class="text-gray-700">
                    <div>Status: <span class="font-semibold">{{ ucfirst($booking->status) }}</span></div>
                    <div>Total: <span class="font-bold text-blue-700">Rp{{ number_format($booking->price, 0, ',', '.') }}</span></div>
                </div>
            </div>

            <div class="mt-10 text-sm text-gray-400">
                Thank you for booking with NextSpace!
            </div>
        </div>
    </div>
</x-app-layout>