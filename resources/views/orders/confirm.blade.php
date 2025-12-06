<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Konfirmasi Membership
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Rincian Langganan</h3>

                    <div class="border rounded-lg p-4 mb-6">
                        <div class="flex gap-4 items-start">
                            {{-- Icon Membership (Generic) --}}
                            <div class="w-24 h-24 bg-indigo-100 rounded flex items-center justify-center flex-shrink-0">
                                <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                </svg>
                            </div>
                            
                            <div class="flex-1">
                                <h4 class="font-semibold text-xl text-gray-900">{{ $membership->nama_plan }}</h4>
                                <div class="mt-2 flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Durasi: {{ $membership->formatted_duration ?? $membership->durasi . ' Hari' }}
                                </div>
                                <p class="mt-2 text-sm text-gray-500">{{ $membership->deskripsi }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-6 bg-gray-50 p-4 rounded-lg">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Harga Paket:</span>
                            <span class="font-semibold">Rp {{ number_format($membership->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Biaya Admin:</span>
                            <span class="font-semibold">Rp 0</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3 flex justify-between items-center">
                            <span class="text-lg font-semibold">Total Tagihan:</span>
                            <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($membership->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Form Submit ke OrderController --}}
                    <form action="{{ route('membership.process', $membership) }}" method="POST">
                        @csrf
                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg shadow transition duration-200">
                                Bayar & Aktifkan
                            </button>
                            <a href="{{ route('members.dashboard') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 px-4 rounded-lg text-center transition duration-200">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>