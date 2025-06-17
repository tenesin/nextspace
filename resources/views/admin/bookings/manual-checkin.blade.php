<x-app-layout>
    <div class="max-w-md mx-auto mt-10 bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Manual Check-in</h2>

        @if (session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="mb-4 p-2 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('admin.booking.manualCheckin') }}">
            @csrf
            <label for="booking_id" class="block mb-2 font-medium">Booking ID</label>
            <input
                type="text"
                name="booking_id"
                id="booking_id"
                class="w-full border rounded px-3 py-2 mb-4"
                required
            />
            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded font-semibold hover:bg-blue-700 transition"
            >
                Check In
            </button>
        </form>
    </div>
</x-app-layout>
