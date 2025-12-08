<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pelatih: ') . $pelatih->nama_pelatih }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.pelatih.index') }}" class="text-blue-500 hover:text-blue-700">
                    &larr; Kembali ke Daftar Pelatih
                </a>
            </div>

            {{-- Kartu Detail Pelatih --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <span class="text-sm text-gray-500">Nama Pelatih</span>
                            <p class="font-semibold text-lg text-gray-900">{{ $pelatih->nama_pelatih }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Spesialisasi</span>
                            <p class="font-medium text-gray-800">{{ $pelatih->spesialisasi ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Bergabung Sejak</span>
                            <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($pelatih->tanggal_masuk)->format('d F Y') }}</p>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end">
                        <a href="{{ route('admin.pelatih.edit', $pelatih) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Edit Pelatih Ini
                        </a>
                    </div>
                </div>
            </div>

            {{-- Kartu Daftar Kelas yang Diajar --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-lg text-gray-900 mb-4">Kelas yang Diajar</h3>
                    @if($pelatih->kelas->isNotEmpty())
                        <ul class="divide-y divide-gray-200">
                            @foreach($pelatih->kelas as $kelas)
                                <li class="py-3">
                                    <p class="font-medium text-gray-800">{{ $kelas->nama_kelas }}</p>
                                    <p class="text-sm text-gray-600">
                                        Waktu: {{ \Carbon\Carbon::parse($kelas->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($kelas->waktu_selesai)->format('H:i') }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center text-gray-500">Pelatih ini belum mengajar kelas apapun.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
