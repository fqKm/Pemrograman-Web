<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pembayaran Berhasil
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-1">Pembayaran Berhasil!</h3>
                        <p class="text-gray-500">Terima kasih, membership Anda kini sudah aktif.</p>
                        <p class="text-sm text-gray-400 mt-1">Order #{{ $order->order_number }}</p>
                    </div>

                    <div class="border border-gray-200 rounded-lg p-5 mb-6">
                        <h4 class="font-semibold text-gray-700 mb-4 pb-2 border-b">Detail Pesanan</h4>

                        <div class="flex items-center gap-4 mb-4">
                            @if ($order->product)
                                {{-- Produk --}}
                                @if ($order->product->photo)
                                    <img src="{{ asset('storage/' . $order->product->photo) }}" alt="{{ $order->product->name }}" class="w-16 h-16 object-cover rounded">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                                <div>
                                    <h5 class="font-bold text-gray-900">{{ $order->product->name }}</h5>
                                    <p class="text-sm text-gray-600">Kode: {{ $order->product->code }}</p>
                                </div>
                            @elseif ($order->membership)
                                {{-- Membership --}}
                                <div class="w-16 h-16 bg-green-100 rounded flex items-center justify-center text-green-600">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-bold text-gray-900">{{ $order->membership->nama_plan }}</h5>
                                    <p class="text-sm text-gray-600">Durasi: {{ $order->membership->formatted_duration ?? $order->membership->durasi . ' Hari' }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="space-y-3 bg-gray-50 p-4 rounded-md">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Metode Pembayaran:</span>
                                <span class="font-medium text-gray-900">Virtual Account</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Waktu Bayar:</span>
                                <span class="font-medium text-gray-900">{{ $order->paid_at ? $order->paid_at->format('d M Y H:i') : now()->format('d M Y H:i') }} WIB</span>
                            </div>
                            <div class="flex justify-between pt-2 border-t border-gray-200 mt-2">
                                <span class="font-bold text-gray-700">Total Dibayar:</span>
                                <span class="text-lg font-bold text-green-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        @if($order->membership_id)
                            <a href="{{ route('members.dashboard') }}" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg text-center transition shadow">
                                Ke Dashboard Member
                            </a>
                        @else
                            <a href="{{ route('customer.products.index') }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg text-center transition shadow">
                                Belanja Lagi
                            </a>
                        @endif
                        
                        <a href="{{ route('dashboard') }}" class="flex-1 bg-white hover:bg-gray-50 text-gray-700 font-bold py-3 px-4 rounded-lg text-center transition border border-gray-300">
                            Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>