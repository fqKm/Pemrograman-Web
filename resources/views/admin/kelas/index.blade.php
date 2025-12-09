<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Jadwal Kelas</h1>
                    <p class="text-sm text-gray-500">Atur jadwal latihan dan pelatih di sini.</p>
                </div>
                
                @if(auth()->user()->hasPermission('buat_kelas'))                
                    <a href="{{ route('admin.kelas.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Buat Kelas Baru
                    </a>
                @endif
            </div>

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex justify-between items-center">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">&times;</button>
                </div>
            @endif

            {{-- Grid Kelas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($kelass as $kelas)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300 flex flex-col h-full">
                        
                        {{-- Card Header --}}
                        <div class="p-6 pb-4">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="font-bold text-lg text-gray-900 line-clamp-1" title="{{ $kelas->nama_kelas }}">
                                    {{ $kelas->nama_kelas }}
                                </h3>
                                {{-- Badge Hari --}}
                                @php
                                    $days = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
                                    $dayName = $days[$kelas->hari] ?? 'N/A';
                                    $today = now()->dayOfWeekIso; // 1 (Mon) - 7 (Sun)
                                    $isToday = $kelas->hari == $today;
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $isToday ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $dayName }}
                                </span>
                            </div>

                            <p class="text-sm text-gray-500 line-clamp-2 min-h-[40px] mb-4">
                                {{ $kelas->deskripsi ?? 'Tidak ada deskripsi.' }}
                            </p>

                            {{-- Info Detail --}}
                            <div class="space-y-3">
                                {{-- Pelatih --}}
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    <span class="font-medium">{{ $kelas->pelatih->nama_pelatih ?? 'Belum ditentukan' }}</span>
                                </div>

                                {{-- Jam --}}
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>
                                        {{ \Carbon\Carbon::parse($kelas->waktu_mulai)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($kelas->waktu_selesai)->format('H:i') }} WIB
                                    </span>
                                </div>

                                {{-- Kapasitas --}}
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    <span>Max: <strong class="text-gray-900">{{ $kelas->kapasitas_maksimum }}</strong> peserta</span>
                                </div>
                            </div>
                        </div>

                        {{-- Card Footer (Actions) --}}
                        <div class="mt-auto bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-end space-x-2">
                            
                            {{-- Show --}}
                            <a href="{{ route('admin.kelas.show', $kelas->id) }}" class="p-2 text-blue-600 hover:bg-blue-100 rounded-full transition" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>

                            @if(auth()->user()->hasPermission('ubah_kelas'))
                                {{-- Edit --}}
                                <a href="{{ route('admin.kelas.edit', $kelas->id) }}" class="p-2 text-yellow-600 hover:bg-yellow-100 rounded-full transition" title="Edit Kelas">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                            @endif

                            @if(auth()->user()->hasPermission('hapus_kelas'))
                                {{-- Delete --}}
                                <form action="{{ route('admin.kelas.destroy', $kelas->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-100 rounded-full transition" title="Hapus Kelas">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <p class="mt-2 text-gray-500 font-medium">Belum ada kelas yang dibuat.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>