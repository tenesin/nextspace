{{-- filepath: resources/views/history/invoice.blade.php --}}
<x-app-layout>
    <div class="max-w-xl mx-auto bg-white shadow rounded-lg p-8 mt-8">
        <h2 class="text-2xl font-bold mb-4">Invoice Pemesanan</h2>
        <div class="mb-2"><strong>Kode Booking:</strong> {{ $booking->booking_id }}</div>
        <div class="mb-2"><strong>Status:</strong> {{ $booking->status }}</div>
        <div class="mb-2"><strong>Nama Pemesan:</strong> {{ $booking->user->name ?? '-' }}</div>
        <div class="mb-2"><strong>Tanggal Booking:</strong> {{ $booking->created_at->format('d M Y H:i') }}</div>
        <div class="mb-2"><strong>Harga:</strong> Rp{{ number_format($booking->price, 0, ',', '.') }}</div>
        {{-- Tambahkan detail lain sesuai kebutuhan --}}
        <a href="{{ route('history.index') }}" class="inline-block mt-6 px-4 py-2 bg-primary text-white rounded hover:bg-primary/90">Kembali ke Riwayat</a>
    </div>
</x-app-layout>