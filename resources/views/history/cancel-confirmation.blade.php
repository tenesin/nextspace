{{-- filepath: resources/views/history/cancel-confirmation.blade.php --}}
<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full text-center">
            <h2 class="text-2xl font-bold mb-4 text-red-600">Reservation Canceled</h2>
            @if($penalty)
                <p class="mb-4 text-gray-700">
                    You canceled less than 1 hour before your booking time.<br>
                    <span class="font-semibold text-red-600">A penalty of 25% ( ${{ number_format($penaltyAmount, 2) }} ) of your reservation cost applies.</span>
                </p>
                <p class="mb-6 text-gray-600">Please proceed to payment to settle your penalty.</p>
                <a href="{{ route('payment.penalty', ['booking' => $booking->id]) }}"
                   class="inline-block bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                    Pay Penalty
                </a>
            @else
                <p class="mb-6 text-gray-700">Your reservation has been canceled successfully.</p>
            @endif
            <a href="{{ route('history.index') }}" class="inline-block mt-4 text-primary hover:underline">Back to My Bookings</a>
        </div>
    </div>
</x-app-layout>