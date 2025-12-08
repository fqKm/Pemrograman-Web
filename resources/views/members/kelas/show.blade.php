<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kelas: ') . $kelas->nama_kelas }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                {{-- Banner / Header --}}
                <div class="bg-indigo-600 p-6 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-3xl font-bold">{{ $kelas->nama_kelas }}</h1>
                            <p class="mt-2 opacity-90">Bersama Pelatih: {{ $kelas->pelatih->nama_pelatih ?? 'TBA' }}</p>
                        </div>
                        <div class="text-right">
                            @if($isJoined)
                                <span class="bg-white text-indigo-600 px-4 py-2 rounded-full font-bold shadow">Anda Terdaftar</span>
                            @elseif($kelas->member_count >= $kelas->kapasitas_maksimum)
                                <span class="bg-red-500 text-white px-4 py-2 rounded-full font-bold shadow">Kelas Penuh</span>
                            @else
                                <span class="bg-green-400 text-white px-4 py-2 rounded-full font-bold shadow">Pendaftaran Dibuka</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    {{-- Informasi Detail --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-4">Informasi Jadwal</h3>
                            <ul class="space-y-4 text-gray-600">
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>{{ \Carbon\Carbon::parse($kelas->waktu_mulai)->format('l, d F Y') }}</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>{{ \Carbon\Carbon::parse($kelas->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($kelas->waktu_selesai)->format('H:i') }} WIB</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    <span>Kuota: {{ $kelas->member_count }} / {{ $kelas->kapasitas_maksimum }} Peserta</span>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-4">Tentang Kelas</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ $kelas->deskripsi ?? 'Tidak ada deskripsi detail untuk kelas ini.' }}
                            </p>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex justify-end gap-4 border-t pt-6">
                        <a href="{{ route('members.kelas.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg transition">
                            Kembali
                        </a>

                        @if(!$isJoined && $kelas->member_count < $kelas->kapasitas_maksimum)
                            <form action="{{ route('members.kelas.join', $kelas->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition shadow-md">
                                    Gabung Kelas Ini
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>