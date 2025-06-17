<x-guest-layout>
    <div class="p-8 text-center">
        <h2 class="text-3xl font-bold text-primary mb-4">Payment Confirmed!</h2>
        <p class="text-text-secondary mb-6">
            Your booking for **{{ $nextspace['title'] }}** at **{{ $selected_time_slot }}** has
            been successfully processed.
        </p>
        <p class="text-text-primary mb-8">Thank you for using NextSpace!</p>

        <a
            href="{{ route('history.index') }}"
            id="viewHistoryBtn"
            class="inline-block bg-primary text-text-light font-semibold py-3 px-6 rounded-lg hover:bg-primary-dark transition duration-300"
        >
            View My Bookings
        </a>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const nextspace = @json($nextspace);
                const selectedTimeSlot = @json($selected_time_slot);
                const bookingId = @json($booking_id); // Get the unique booking ID

                // Construct the order object
                const order = {
                    order_id: bookingId, // Use the unique booking ID
                    nextspace_id: nextspace.id, // The original nextspace ID
                    title: nextspace.title,
                    address: nextspace.address, // Added address for history display
                    image: nextspace.image, // Added image for history display
                    booked_time: selectedTimeSlot,
                    booking_date: new Date().toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric',
                    }), // Formatted date
                    booking_timestamp: new Date().toISOString(), // For sorting or precise QR data
                    status: 'Confirmed',
                };

                // Get existing history or initialize an empty array
                let orderHistory = JSON.parse(localStorage.getItem('nextspaceOrderHistory')) || [];

                // Add the new order to the beginning of the array
                orderHistory.unshift(order);

                // Save back to local storage
                localStorage.setItem('nextspaceOrderHistory', JSON.stringify(orderHistory));

                console.log('Order saved to local storage:', orderHistory);
            });
        </script>
    </div>
</x-guest-layout>
