{{-- filepath: resources/views/admin/nextspaces/index.blade.php --}}
<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header Section --}}
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4"
                >
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900 mb-1">
                            NextSpaces Management
                        </h1>
                        <p class="text-gray-600 text-sm">
                            Manage your spaces and monitor user activity
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <a
                            href="{{ route('admin.nextspaces.export-report') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors"
                        >
                            <svg
                                class="w-4 h-4 mr-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"
                                />
                            </svg>
                            Export Report
                        </a>
                        <a
                            href="{{ route('admin.nextspaces.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors"
                        >
                            <svg
                                class="w-4 h-4 mr-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                ></path>
                            </svg>
                            Create Space
                        </a>
                    </div>
                </div>
            </div>
            
            {{-- Manual Booking Check-in --}}
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-3 text-gray-900">Manual Booking Check-in</h2>

                @if (session('success'))
                    <div class="mb-3 p-2 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="mb-3 p-2 bg-red-100 text-red-800 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                <form
                    method="POST"
                    action="{{ route('admin.booking.manualCheckin') }}"
                    class="flex gap-2 items-end"
                >
                    @csrf
                    <div class="flex-1">
                        <label
                            for="booking_id"
                            class="block text-sm font-medium text-gray-700 mb-1"
                        >
                            Booking ID
                        </label>
                        <input
                            type="text"
                            name="booking_id"
                            id="booking_id"
                            class="w-full border rounded px-3 py-2"
                            required
                        />
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded font-semibold hover:bg-blue-700 transition"
                    >
                        Check In
                    </button>
                </form>
            </div>

            {{-- Statistics Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-md bg-blue-50 text-blue-600 mr-3">
                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                ></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xl font-semibold text-gray-900">
                                {{ $users->count() }}
                            </p>
                            <p class="text-gray-600 text-sm">Users</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-md bg-blue-50 text-blue-600 mr-3">
                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                                ></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xl font-semibold text-gray-900">
                                {{ $nextspaces->count() }}
                            </p>
                            <p class="text-gray-600 text-sm">Spaces</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-md bg-blue-50 text-blue-600 mr-3">
                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"
                                ></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xl font-semibold text-gray-900">
                                Rp{{ number_format($nextspaces->sum('base_price'), 0, ',', '.') }}
                            </p>
                            <p class="text-gray-600 text-sm">Total Value</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Users Section --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Registered Users</h2>
                </div>

                @if ($users->isEmpty())
                    <div class="text-center py-8">
                        <svg
                            class="mx-auto h-12 w-12 text-gray-400 mb-3"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                            ></path>
                        </svg>
                        <p class="text-gray-500 text-sm">No users registered yet</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        User
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Email
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Joined
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Bookings
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-xs font-medium mr-3"
                                                >
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <span class="text-sm font-medium text-gray-900">
                                                    {{ $user->name }}
                                                </span>
                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-3 whitespace-nowrap text-sm text-gray-600"
                                        >
                                            {{ $user->email }}
                                        </td>
                                        <td
                                            class="px-6 py-3 whitespace-nowrap text-sm text-gray-600"
                                        >
                                            {{ $user->created_at->format('M j, Y') }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800"
                                            >
                                                {{ $user->bookings_count }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- NextSpaces Section --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Your NextSpaces</h2>
                </div>

                @if ($nextspaces->isEmpty())
                    <div class="text-center py-12">
                        <svg
                            class="mx-auto h-12 w-12 text-gray-400 mb-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                            ></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No NextSpaces yet</h3>
                        <p class="text-gray-500 text-sm mb-4">
                            Create your first NextSpace to get started.
                        </p>
                        <a
                            href="{{ route('admin.nextspaces.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors"
                        >
                            <svg
                                class="w-4 h-4 mr-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                ></path>
                            </svg>
                            Create Your First NextSpace
                        </a>
                    </div>
                @else
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($nextspaces as $nextspace)
                                <div
                                    class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow"
                                >
                                    <div class="relative">
                                        <img
                                            src="{{ $nextspace->image ?? 'https://placehold.co/400x200/E5E7EB/6B7280?text=NextSpace' }}"
                                            alt="{{ $nextspace->title }}"
                                            class="w-full h-32 object-cover"
                                        />
                                        <span
                                            class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded text-xs font-medium"
                                        >
                                            Active
                                        </span>
                                    </div>

                                    <div class="p-4">
                                        <h3 class="font-medium text-gray-900 mb-2 truncate">
                                            {{ $nextspace->title }}
                                        </h3>

                                        <div class="flex items-center text-gray-600 mb-2">
                                            <svg
                                                class="w-4 h-4 mr-1 flex-shrink-0"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                                ></path>
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                ></path>
                                            </svg>
                                            <span class="text-xs truncate">
                                                {{ $nextspace->address }}
                                            </span>
                                        </div>

                                        <div class="mb-3">
                                            <p class="text-xs font-medium text-gray-700 mb-1">
                                                Time Slots:
                                            </p>
                                            <div
                                                class="{{ $nextspace->timeSlots->count() > 4 ? 'max-h-28 overflow-y-auto pr-2' : '' }} space-y-1"
                                            >
                                                @foreach ($nextspace->timeSlots as $slot)
                                                    <div
                                                        class="text-xs text-gray-600 flex justify-between"
                                                    >
                                                        <span>{{ $slot->slot }}</span>
                                                        <span class="text-blue-600 font-medium">
                                                            {{ $slot->pivot->capacity }}
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-lg font-semibold text-blue-600">
                                                Rp{{ number_format($nextspace->base_price, 0, ',', '.') }}
                                            </span>
                                            <span class="text-xs text-gray-500">Base Price</span>
                                        </div>

                                        <div class="flex gap-2">
                                            <a
                                                href="{{ route('nextspaces.show', ['id' => $nextspace->id]) }}"
                                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium py-2 px-3 rounded text-center transition-colors"
                                            >
                                                View
                                            </a>
                                            <a
                                                href="{{ route('admin.nextspaces.edit', $nextspace->id) }}"
                                                class="flex-1 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-medium py-2 px-3 rounded text-center transition-colors"
                                            >
                                                Edit
                                            </a>
                                            <form
                                                action="{{ route('admin.nextspaces.destroy', $nextspace->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this NextSpace?')"
                                                class="flex-1"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="w-full bg-red-50 hover:bg-red-100 text-red-700 text-xs font-medium py-2 px-3 rounded transition-colors"
                                                >
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
