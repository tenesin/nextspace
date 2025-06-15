<x-app-layout>
    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb Navigation -->
            <nav class="text-sm text-gray-600 mb-6" aria-label="Breadcrumb">
                <div class="flex items-center space-x-2 bg-white/60 backdrop-blur-sm rounded-lg px-4 py-2">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors font-medium">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                        </svg>
                        Dashboard
                    </a>
                    <span class="text-gray-400">/</span>
                    <a href="{{ route('history.index') }}" class="hover:text-blue-600 transition-colors font-medium">My Bookings</a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-900 font-semibold">{{ $booking->booking_id }}</span>
                </div>
            </nav>

            <!-- Main Content Card -->
            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden">
                <!-- Header with Gradient -->
                <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 px-8 py-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl font-bold text-white mb-3">Booking Confirmation</h1>
                            <div class="flex items-center text-blue-100">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a1.994 1.994 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <span class="font-mono text-lg font-semibold">{{ $booking->booking_id }}</span>
                            </div>
                        </div>
                        <!-- Status Badge -->
                        <div class="text-right">
                            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold
                                @if(strtolower($booking->status) === 'confirmed') bg-green-500 text-white
                                @elseif(strtolower($booking->status) === 'pending') bg-yellow-400 text-gray-800
                                @elseif(strtolower($booking->status) === 'paid') bg-blue-500 text-white
                                @else bg-gray-400 text-white @endif
                                shadow-lg">
                                <div class="w-2 h-2 rounded-full mr-2 bg-white opacity-80"></div>
                                {{ ucfirst($booking->status) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 lg:p-10">
                    <!-- Status Messages -->
                    @if(session('success'))
                        <div class="mb-8 bg-green-50 border-l-4 border-green-400 p-6 rounded-r-xl shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-green-800 font-semibold text-lg">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-8 bg-red-50 border-l-4 border-red-400 p-6 rounded-r-xl shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-red-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-red-800 font-semibold text-lg">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    @if(!session('success') && !session('error') && strtolower($booking->status) === 'confirmed')
                        <div class="mb-8 bg-blue-50 border-l-4 border-blue-400 p-6 rounded-r-xl shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-blue-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-blue-800 font-semibold text-lg">Your booking is confirmed and ready!</p>
                            </div>
                        </div>
                    @endif

                    <!-- Main Content Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mb-10">
                        <!-- Booking Details (Left Column) -->
                        <div class="lg:col-span-2 space-y-8">
                            <!-- Space Information -->
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-8 shadow-inner">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <div class="md:w-2/5">
                                        <img src="{{ $booking->nextspace_image_url }}" 
                                             alt="{{ $booking->nextspace_title }}" 
                                             class="w-full h-56 object-cover rounded-xl shadow-lg ring-4 ring-white">
                                    </div>
                                    <div class="md:w-3/5 flex flex-col justify-center">
                                        <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $booking->nextspace_title }}</h2>
                                        <div class="flex items-start text-gray-600 mb-6">
                                            <svg class="w-6 h-6 mt-1 mr-3 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span class="text-lg">{{ $booking->nextspace_address }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Details Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Date Card -->
                                <div class="bg-white border-2 border-blue-100 rounded-2xl p-6 hover:shadow-lg transition-shadow">
                                    <div class="flex items-center mb-4">
                                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 0v3m-4 0a4 4 0 108 0V7"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900">Booking Date</h3>
                                    </div>
                                    <p class="text-3xl font-bold text-blue-600 mb-1">{{ $booking->booked_for?->format('M d, Y') ?? 'N/A' }}</p>
                                    <p class="text-gray-500 font-medium">{{ $booking->booked_for?->format('l') ?? '' }}</p>
                                </div>

                                <!-- Time Card -->
                                <div class="bg-white border-2 border-green-100 rounded-2xl p-6 hover:shadow-lg transition-shadow">
                                    <div class="flex items-center mb-4">
                                        <div class="bg-green-100 p-3 rounded-full mr-4">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900">Time Slot</h3>
                                    </div>
                                    <p class="text-3xl font-bold text-green-600">{{ $booking->booked_time_slot }}</p>
                                </div>

                                <!-- Price Card -->
                                <div class="bg-white border-2 border-purple-100 rounded-2xl p-6 hover:shadow-lg transition-shadow md:col-span-2">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="bg-purple-100 p-3 rounded-full mr-4">
                                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-900">Total Price</h3>
                                        </div>
                                        <p class="text-4xl font-bold text-purple-600">${{ number_format($booking->price, 2) }}</p>
                                    </div>
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
                                <div class="bg-white border-2 border-indigo-100 rounded-2xl p-6 shadow-sm">
                                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                        <div class="bg-indigo-100 p-2 rounded-full mr-3">
                                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                            </svg>
                                        </div>
                                        Additional Services
                                    </h3>
                                    <div class="space-y-3">
                                        @foreach($safeSelectedServices as $service)
                                            <div class="flex justify-between items-center py-3 px-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                                                <span class="text-gray-800 font-medium">{{ $service['name'] }}</span>
                                                <span class="font-bold text-gray-900 text-lg">${{ number_format($service['price'], 2) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- QR Code Section (Right Column) -->
                        <div class="lg:col-span-1">
                            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 text-center border-2 border-indigo-100 shadow-lg sticky top-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center justify-center">
                                    <div class="bg-indigo-100 p-2 rounded-full mr-3">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                        </svg>
                                    </div>
                                    Entry Pass
                                </h3>
                                
                                @php
                                    $qrBookingDate = $booking->booked_for?->format('Y-m-d') ?? 'N/A';
                                    $qrData = "Booking ID: {$booking->booking_id}\nNextSpace: {$booking->nextspace_title}\nTime: {$booking->booked_time_slot}\nDate: {$qrBookingDate}";
                                    $qrCodeUrl = route('qr.generate', ['data' => urlencode($qrData)]);
                                @endphp
                                
                                <div class="bg-white p-6 rounded-2xl shadow-lg border-4 border-dashed border-indigo-200 mb-6">
                                    <img src="{{ $qrCodeUrl }}" 
                                         alt="QR Code for Booking {{ $booking->booking_id }}" 
                                         class="w-44 h-44 mx-auto">
                                </div>
                                
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-600 mb-2">Booking ID:</p>
                                        <div class="bg-white px-4 py-3 rounded-xl border-2 border-gray-200">
                                            <p class="font-mono font-bold text-xl text-gray-900">{{ $booking->booking_id }}</p>
                                        </div>
                                    </div>
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                                        <p class="text-sm text-yellow-800 font-medium">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>
                                            </svg>
                                            Present this QR code and ID upon arrival for quick check-in.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Penalty Warning -->
                    @if($penalty)
                        <div class="mb-8 bg-amber-50 border-l-4 border-amber-400 rounded-r-xl p-6 shadow-sm">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-amber-600 mt-0.5 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                <div>
                                    <h4 class="font-bold text-amber-800 mb-2 text-lg">Cancellation Policy</h4>
                                    <p class="text-amber-700">Canceling less than 1 hour before your booked time may incur a 25% penalty fee.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-8 shadow-inner">
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            {{-- Check In Button --}}
                            @if(in_array(strtolower($booking->status), ['confirmed', 'paid']))
                                <form method="POST" action="{{ route('booking.checkin', $booking->id) }}">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold text-lg rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Check In Now
                                    </button>
                                </form>
                            @endif

                            {{-- Pay Button --}}
                            @if(in_array(strtolower($booking->status), ['pending payment', 'pending']))
                                <a href="{{ route('payment.form', $booking->nextspace_id) }}" 
                                   class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold text-lg rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                    Complete Payment
                                </a>
                            @endif

                            {{-- Cancel Button --}}
                            @if(in_array(strtolower($booking->status), ['confirmed', 'pending payment', 'pending', 'paid']))
                                <form method="POST" action="{{ route('booking.cancel', $booking->id) }}" 
                                      onsubmit="return confirm('Are you sure you want to cancel this booking? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold text-lg rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Cancel Booking
                                    </button>
                                </form>
                            @endif
                        </div>

                        {{-- Cancellation Policy Note --}}
                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>
                                </svg>
                                Canceling less than 1 hour before the booked time may incur a 25% penalty.
                            </p>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="text-center mt-10 pt-8 border-t border-gray-200">
                        <a href="{{ route('history.index') }}" 
                           class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-50 text-gray-700 font-semibold text-lg rounded-xl border-2 border-gray-200 transition-all duration-200 hover:shadow-md">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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