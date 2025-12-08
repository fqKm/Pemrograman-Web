<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kelas: ') . $kela->nama_kelas }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.kelas.index') }}" class="text-blue-500 hover:text-blue-700">
                    &larr; Kembali ke Daftar Kelas
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <span class="text-sm text-gray-500">Nama Kelas</span>
                            <p class="font-semibold text-lg text-gray-900">{{ $kela->nama_kelas }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Pelatih</span>
                            <p class="font-medium text-gray-800">{{ $kela->pelatih->nama_pelatih ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Hari : </span>
                            <p class="font-medium text-gray-800">
                                <?php
                                echo match ($kela->hari) {
                                        1 => "Senin",
                                        2 => "Selasa",
                                        3 => "Rabu",
                                        4 => "Kamis",
                                        5 => "Jumat",
                                        6 => "Sabtu",
                                        7 => "Minggu",
                                        default => "Hari tidak valid",
                                    };
                                ?>
                            </p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Waktu</span>
                            <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($kela->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($kela->waktu_selesai)->format('H:i') }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Kapasitas Maksimum</span>
                            <p class="font-medium text-gray-800">{{ $kela->kapasitas_maksimum }} Orang</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Deskripsi</span>
                            <p class="font-medium text-gray-800">{{ $kela->deskripsi ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end">
                        <a href="{{ route('admin.kelas.edit', $kela) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Edit Kelas Ini
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
