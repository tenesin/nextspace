<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb Navigation -->
            <nav class="text-sm text-gray-600 mb-4" aria-label="Breadcrumb">
                <div class="flex items-center space-x-2 bg-white rounded-lg px-3 py-2 shadow-sm">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                        </svg>
                        Dashboard
                    </a>
                    <span class="text-gray-400">/</span>
                    <a href="{{ route('history.index') }}" class="hover:text-blue-600 transition-colors">My Bookings</a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-900 font-medium">{{ $booking->booking_id }}</span>
                </div>
            </nav>

            <!-- Main Content Card -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gray-900 px-6 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-white mb-2">Booking Confirmation</h1>
                            <div class="flex items-center text-gray-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a1.994 1.994 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <span class="font-mono">{{ $booking->booking_id }}</span>
                            </div>
                        </div>
                        <!-- Status Badge -->
                        <div class="text-right">
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if(strtolower($booking->status) === 'confirmed') bg-green-100
                                @elseif(strtolower($booking->status) === 'pending')
                                @elseif(strtolower($booking->status) === 'paid') text-blue-800
                                @else @endif">
                                <div class="w-2 h-2 rounded-full mr-2 
                                    @if(strtolower($booking->status) === 'confirmed') bg-green-500
                                    @elseif(strtolower($booking->status) === 'pending')
                                    @elseif(strtolower($booking->status) === 'paid')
                                    @else @endif"></div>
                                {{ ucfirst($booking->status) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Status Messages -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 p-4 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-green-800 font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 bg-red-50 border border-red-200 p-4 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-red-800 font-medium">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    @if(!session('success') && !session('error') && strtolower($booking->status) === 'confirmed')
                        <div class="mb-6 bg-blue-50 border border-blue-200 p-4 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-blue-800 font-medium">Your booking is confirmed and ready!</p>
                            </div>
                        </div>
                    @endif

                    <!-- Main Content Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
                        <!-- Booking Details (Left Column) -->
                        <div class="lg:col-span-3 space-y-6">
                            <!-- Space Information -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <div class="flex flex-col md:flex-row gap-4">
                                    <div class="md:w-1/3">
                                        <img src="{{ $booking->nextspace_image_url }}" 
                                             alt="{{ $booking->nextspace_title }}" 
                                             class="w-full h-40 object-cover rounded-lg">
                                    </div>
                                    <div class="md:w-2/3">
                                        <h2 class="text-xl font-bold text-gray-900 mb-3">{{ $booking->nextspace_title }}</h2>
                                        <div class="flex items-start text-gray-600">
                                            <svg class="w-5 h-5 mt-0.5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span>{{ $booking->nextspace_address }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Details Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Date Card -->
                                <div class="bg-white border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <h3 class="font-medium text-gray-900">Date</h3>
                                    </div>
                                    <p class="text-lg font-bold text-gray-900">{{ $booking->booked_for?->format('M d, Y') ?? 'N/A' }}</p>
                                    <p class="text-gray-500 text-sm">{{ $booking->booked_for?->format('l') ?? '' }}</p>
                                </div>

                                <!-- Time Card -->
                                <div class="bg-white border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <h3 class="font-medium text-gray-900">Time</h3>
                                    </div>
                                    <p class="text-lg font-bold text-gray-900">{{ $booking->booked_time_slot }}</p>
                                </div>

                                <!-- Price Card -->
                                <div class="bg-white border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                        <h3 class="font-medium text-gray-900">Total</h3>
                                    </div>
                                    <p class="text-lg font-bold text-gray-900">${{ number_format($booking->price, 2) }}</p>
                                </div>
                            </div>

                            <!-- Additional Services -->
                            @php
                                $safeSelectedServices = $booking->selected_services_details ?? [];
                                if (is_string($safeSelectedServices)) {
                                    $decoded = json_decode($safeSelectedServices, true);
                                    $safeSelectedServices = is_array($decoded) ? $decoded : [];
                                }
                                $safeSelectedServices = is_array($safeSelectedServices) ? $safeSelectedServices : [];
                            @endphp

                            @if(!empty($safeSelectedServices))
                                <div class="bg-white border border-gray-200 rounded-lg p-4">
                                    <h3 class="font-medium text-gray-900 mb-3 flex items-center">
                                        <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                        </svg>
                                        Additional Services
                                    </h3>
                                    <div class="space-y-2">
                                        @foreach($safeSelectedServices as $service)
                                            <div class="flex justify-between items-center py-2 px-3 bg-gray-50 rounded">
                                                <span class="text-gray-700">{{ $service['name'] }}</span>
                                                <span class="font-medium text-gray-900">${{ number_format($service['price'], 2) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- QR Code Section (Right Column) -->
                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 rounded-lg p-6 text-center">
                                <h3 class="font-medium text-gray-900 mb-4 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                    </svg>
                                    Entry Pass
                                </h3>
                                
                                @php
                                    $qrBookingDate = $booking->booked_for?->format('Y-m-d') ?? 'N/A';
                                    $qrData = "Booking ID: {$booking->booking_id}\nNextSpace: {$booking->nextspace_title}\nTime: {$booking->booked_time_slot}\nDate: {$qrBookingDate}";
                                    $qrCodeUrl = route('qr.generate', ['data' => urlencode($qrData)]);
                                @endphp
                                
                                <div class="bg-white p-4 rounded-lg border-2 border-dashed border-gray-300 mb-4">
                                    <img src="{{ $qrCodeUrl }}" 
                                         alt="QR Code for Booking {{ $booking->booking_id }}" 
                                         class="w-32 h-32 mx-auto">
                                </div>
                                
                                <div class="space-y-3">
                                    <div class="bg-white px-3 py-2 rounded border">
                                        <p class="text-xs text-gray-500 mb-1">Booking ID</p>
                                        <p class="font-mono text-xs text-gray-900">{{ $booking->booking_id }}</p>
                                    </div>
                                    <div class="bg-yellow-50 border border-yellow-200 rounded p-3">
                                        <p class="text-xs text-yellow-800">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>
                                            </svg>
                                            Present this QR code upon arrival
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Review Section -->
                    @if(strtolower($booking->status) === 'checked in' && !$booking->review)
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h3 class="font-medium text-gray-900 mb-3">Rate Your Experience</h3>
                            <form method="POST" action="{{ route('reviews.store', $booking->id) }}">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                        <select name="rating" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                            <option value="">Select rating</option>
                                            @for($i=5; $i>=1; $i--)
                                                <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Comment</label>
                                        <textarea name="comment" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Share your experience..." required></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                                    Submit Review
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Penalty Warning -->
                    @if($penalty)
                        <div class="mb-6 bg-amber-50 border border-amber-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-amber-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                <div>
                                    <h4 class="font-medium text-amber-800 mb-1">Cancellation Policy</h4>
                                    <p class="text-sm text-amber-700">Canceling less than 1 hour before your booked time may incur a 25% penalty fee.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <div class="flex flex-wrap gap-3 justify-center">
                            {{-- Check In Button --}}
                            @if(in_array(strtolower($booking->status), ['confirmed', 'paid']))
                                <form method="POST" action="{{ route('booking.checkin', $booking->id) }}">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Check In
                                    </button>
                                </form>
                            @endif

                            {{-- Pay Button --}}
                            @if(in_array(strtolower($booking->status), ['pending payment', 'pending']))
                                <a href="{{ route('payment.form', $booking->nextspace_id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                    Pay Now
                                </a>
                            @endif

                            {{-- Cancel Button --}}
                            @if(in_array(strtolower($booking->status), ['confirmed', 'pending payment', 'pending', 'paid']))
                                <form method="POST" action="{{ route('booking.cancel', $booking->id) }}" 
                                      onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Cancel
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Cancellation Policy Note -->
                        <div class="mt-3 text-center">
                            <p class="text-xs text-gray-500 flex items-center justify-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>
                                </svg>
                                25% penalty for cancellations within 1 hour of booking time
                            </p>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="text-center">
                        <a href="{{ route('history.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 font-medium rounded border border-gray-300 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to My Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>