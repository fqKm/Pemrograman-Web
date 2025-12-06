<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Menunggu Pembayaran
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-100 rounded-full mb-4 animate-pulse">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Menunggu Pembayaran</h3>
                        <p class="text-gray-600">Order #{{ $order->order_number }}</p>
                    </div>

                    <div class="border rounded-lg p-4 mb-6 bg-gray-50">
                        <p class="text-sm text-gray-600 mb-2 font-medium">Nomor Virtual Account:</p>
                        <div class="flex items-center gap-2">
                            <input type="text" value="{{ $order->va_number }}" id="va-number" readonly
                                class="flex-1 font-mono text-2xl font-bold text-gray-800 bg-white border-gray-300 rounded-md py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
                            <button onclick="copyVA()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-md font-medium transition">
                                Salin
                            </button>
                        </div>
                    </div>

                    <div class="border rounded-lg p-4 mb-6">
                        <div class="flex items-center gap-4 mb-4">
                            @if ($order->product)
                                @if ($order->product->photo)
                                    <img src="{{ asset('storage/' . $order->product->photo) }}" alt="{{ $order->product->name }}" class="w-16 h-16 object-cover rounded">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-semibold text-lg">{{ $order->product->name }}</h4>
                                    <p class="text-sm text-gray-600">Jumlah: {{ $order->quantity }} Item</p>
                                </div>
                            @elseif ($order->membership)
                                <div class="w-16 h-16 bg-indigo-100 rounded flex items-center justify-center text-indigo-600">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-lg">Membership: {{ $order->membership->nama_plan }}</h4>
                                    <p class="text-sm text-gray-600">Durasi: {{ $order->membership->formatted_duration }}</p>
                                </div>
                            @endif
                        </div>
                        
                        <div class="border-t pt-3 flex justify-between items-center">
                            <span class="font-semibold text-gray-700">Total Tagihan:</span>
                            <span class="text-xl font-bold text-indigo-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6 flex items-start gap-3">
                        <svg class="w-5 h-5 text-yellow-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-gray-700">
                            Selesaikan pembayaran sebelum <span class="font-bold">{{ $order->expired_at->format('d M Y H:i') }} WIB</span>.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3">
                        @if($order->payment_url)
                        <a href="{{ $order->payment_url }}" target="_blank" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg text-center transition">
                            Buka Simulasi Pembayaran (Sandbox)
                        </a>
                        @endif
                        
                        {{-- Redirect tombol 'Kembali' sesuai tipe pesanan --}}
                        <a href="{{ $order->membership_id ? route('membership.index') : route('customer.products.index') }}" 
                           class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-4 rounded-lg text-center transition border border-gray-300">
                            Kembali ke Daftar
                        </a>
                    </div>

                    <div class="text-center mt-6">
                        <div class="inline-flex items-center gap-2 text-sm text-gray-500">
                            <svg class="animate-spin h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Halaman akan refresh otomatis jika pembayaran diterima...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyVA() {
            const vaInput = document.getElementById('va-number');
            vaInput.select();
            document.execCommand('copy');
            alert('Nomor VA berhasil disalin!');
        }

        // Auto check payment status every 5 seconds
        // Route check status ini harus dibuat umum atau spesifik membership
        const checkUrl = '{{ $order->membership_id ? route("membership.orders.check-status", $order) : route("orders.check-status", $order) }}';
        const successUrl = '{{ $order->membership_id ? route("membership.orders.success", $order) : route("orders.success", $order) }}';

        setInterval(function() {
            fetch(checkUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'paid') {
                        window.location.href = successUrl;
                    }
                })
                .catch(err => console.error('Gagal cek status:', err));
        }, 5000);
    </script>
</x-app-layout>