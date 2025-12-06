<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Membership') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Rincian Langganan</h3>

                    <div class="bg-gray-50 rounded-lg p-6 mb-6 flex flex-col md:flex-row gap-6 items-center md:items-start">
                        <div class="w-24 h-24 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                        </div>

                        <div class="flex-1 w-full text-center md:text-left">
                            <h4 class="text-2xl font-bold text-gray-900 mb-1">{{ $membership->nama_plan }}</h4>
                            <div class="flex items-center justify-center md:justify-start gap-2 text-gray-600 mb-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-medium">Durasi: {{ $membership->formatted_duration }}</span>
                            </div>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $membership->deskripsi }}</p>
                        </div>
                    </div>

                    <div class="space-y-3 mb-8">
                        <div class="flex justify-between text-gray-600">
                            <span>Harga Paket</span>
                            <span>Rp {{ number_format($membership->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Admin</span>
                            <span>Rp 0</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3 flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-800">Total Pembayaran</span>
                            <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($membership->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <form action="{{ route('membership.process', $membership) }}" method="POST">
                        @csrf
                        <div class="flex flex-col md:flex-row gap-4">
                            <a href="{{ route('membership.index') }}" class="w-full md:w-1/2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 px-4 rounded-lg text-center transition duration-200">
                                Batal
                            </a>
                            <button type="submit" class="w-full md:w-1/2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition duration-200 flex justify-center items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Bayar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>