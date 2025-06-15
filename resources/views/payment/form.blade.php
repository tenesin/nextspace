<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                
                {{-- Header --}}
                <div class="bg-blue-500 text-white p-4 text-center">
                    <h2 class="text-xl font-bold">Konfirmasi Booking</h2>
                    <p class="text-blue-100 text-sm mt-1">Lengkapi reservasi Anda</p>
                </div>

                {{-- Success Message --}}
                @if (session('status'))
                    <div class="m-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-700">
                        ✓ {{ session('status') }}
                    </div>
                @endif

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="m-4 p-3 bg-red-100 border-l-4 border-red-500">
                        <p class="text-red-700 font-medium">Mohon perbaiki kesalahan berikut:</p>
                        <ul class="text-red-600 text-sm mt-1 ml-4">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="p-4">
                    {{-- Space Info Card --}}
                    <div class="bg-gray-100 rounded-lg p-4 mb-6">
                        <div class="flex items-center space-x-3">
<img 
    src="{{ $nextspace->image ?? 'https://placehold.co/120x120/E5E7EB/6B7280?text=Ruang' }}" 
    alt="{{ $nextspace->title }}" 
    class="w-28 h-28 object-cover rounded-lg border border-gray-200 shadow-sm"
/>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $nextspace->title }}</h3>
                                <p class="text-sm text-gray-600">📍 {{ $nextspace->address }}</p>
                                <p class="text-lg font-bold text-blue-600 mt-1">
                                    $ {{ number_format($nextspace->base_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('payment.process') }}" class="space-y-4">                
                        @csrf
                        <input type="hidden" name="nextspace_id" value="{{ $nextspace_id }}">

                        {{-- Booking Details --}}
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-3">📅 Detail Booking</h3>
                            
                            {{-- Date --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="booking_date"
                                    value="{{ old('booking_date') }}"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required
                                />
                                @error('booking_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Time Slot --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Waktu <span class="text-red-500">*</span>
                                </label>
                                <select 
                                    name="selected_time_slot_id"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required
                                >
                                    <option value="">Pilih waktu</option>
                                    @foreach ($nextspace->timeSlots as $slot)
                                        <option value="{{ $slot->id }}" {{ old('selected_time_slot_id') == $slot->id ? 'selected' : '' }}>
                                            {{ $slot->slot }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selected_time_slot_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Services --}}
                            @if($nextspace->services->count() > 0)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    🛎️ Layanan Tambahan (Opsional)
                                </label>
                                <div class="space-y-2 max-h-32 overflow-y-auto">
                                    @foreach ($nextspace->services as $service)
                                        <label class="flex items-center p-2 bg-gray-50 rounded border hover:bg-gray-100 cursor-pointer">
                                            <input 
                                                type="checkbox" 
                                                name="selected_service_ids[]" 
                                                value="{{ $service->id }}"
                                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                                {{ in_array($service->id, old('selected_service_ids', [])) ? 'checked' : '' }}
                                            />
                                            <div class="ml-2 flex-1 flex justify-between">
                                                <span class="text-sm">{{ $service->name }}</span>
                                                <span class="text-sm font-medium text-blue-600">
                                                    +$ {{ number_format($service->price ?? 0, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- Payment Method --}}
                        <div class="border-t pt-4">
                            <h3 class="font-semibold text-gray-900 mb-3">💳 Metode Pembayaran</h3>
                            
                            <div class="space-y-3">
                                {{-- Transfer Bank --}}
                                <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:border-blue-500 cursor-pointer">
                                    <input type="radio" name="payment_method" value="bank_transfer" class="w-4 h-4 text-blue-600" required checked>
                                    <div class="ml-3">
                                        <div class="font-medium">🏦 Transfer Bank</div>
                                        <div class="text-xs text-gray-500">BCA, Mandiri, BNI, BRI</div>
                                    </div>
                                </label>

                                {{-- E-Wallet --}}
                                <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:border-blue-500 cursor-pointer">
                                    <input type="radio" name="payment_method" value="ewallet" class="w-4 h-4 text-blue-600" required>
                                    <div class="ml-3">
                                        <div class="font-medium">📱 E-Wallet</div>
                                        <div class="text-xs text-gray-500">GoPay, OVO, DANA, ShopeePay</div>
                                    </div>
                                </label>

                                {{-- QRIS --}}
                                <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:border-blue-500 cursor-pointer">
                                    <input type="radio" name="payment_method" value="qris" class="w-4 h-4 text-blue-600" required>
                                    <div class="ml-3">
                                        <div class="font-medium">📊 QRIS</div>
                                        <div class="text-xs text-gray-500">Scan QR untuk pembayaran instan</div>
                                    </div>
                                </label>

                                {{-- Cash --}}
                                <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:border-blue-500 cursor-pointer">
                                    <input type="radio" name="payment_method" value="cash" class="w-4 h-4 text-blue-600" required>
                                    <div class="ml-3">
                                        <div class="font-medium">💵 Bayar di Tempat</div>
                                        <div class="text-xs text-gray-500">Bayar tunai saat tiba di lokasi</div>
                                    </div>
                                </label>
                            </div>
                            
                            @error('payment_method')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Hidden fields to prevent old validation errors --}}
                        <input type="hidden" name="card_number" value="not_required">
                        <input type="hidden" name="expiry_date" value="not_required">
                        <input type="hidden" name="cvc" value="not_required">

                        {{-- Info Notice --}}
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                            <div class="flex items-start">
                                <span class="text-blue-500 mr-2">ℹ️</span>
                                <div class="text-sm text-blue-700">
                                    <p class="font-medium">Informasi Pembayaran</p>
                                    <p>Anda akan menerima instruksi pembayaran setelah konfirmasi booking.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <button 
                            type="submit" 
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-4 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center"
                        >
                            🔒 Konfirmasi & Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set minimum date to today
        document.querySelector('input[type="date"]').min = new Date().toISOString().split('T')[0];
        
        // Add smooth hover effects for payment options
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('label').forEach(label => {
                    if (label.querySelector('input[name="payment_method"]')) {
                        label.classList.remove('border-blue-500', 'bg-blue-50');
                    }
                });
                this.closest('label').classList.add('border-blue-500', 'bg-blue-50');
            });
        });
        
        // Set default selection styling
        document.querySelector('input[name="payment_method"]:checked').closest('label').classList.add('border-blue-500', 'bg-blue-50');
    </script>
</x-app-layout>