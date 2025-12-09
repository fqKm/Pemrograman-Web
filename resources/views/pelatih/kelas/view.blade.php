<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kelas: ') . $kela->nama_kelas }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Breadcrumb / Back Button --}}
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('kelas.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Daftar Kelas
                </a>
                <a href="{{ route('kelas.edit', $kela->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-bold py-2 px-4 rounded-lg shadow-sm transition">
                    Edit Kelas
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KOLOM KIRI: INFO KELAS --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Informasi Kelas</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Nama Kelas</span>
                                <p class="text-base font-medium text-gray-900">{{ $kela->nama_kelas }}</p>
                            </div>

                            <div>
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Jadwal</span>
                                <div class="flex items-center mt-1">
                                    <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    @php
                                        $days = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
                                    @endphp
                                    <p class="text-gray-700">{{ $days[$kela->hari] ?? 'Hari tidak valid' }}</p>
                                </div>
                                <div class="flex items-center mt-1">
                                    <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <p class="text-gray-700">
                                        {{ \Carbon\Carbon::parse($kela->waktu_mulai)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($kela->waktu_selesai)->format('H:i') }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Kapasitas</span>
                                <div class="flex items-center justify-between mt-1">
                                    <p class="text-gray-700">{{ $kela->member->count() }} / {{ $kela->kapasitas_maksimum }} Peserta</p>
                                    @if($kela->member->count() >= $kela->kapasitas_maksimum)
                                        <span class="px-2 py-1 bg-red-100 text-red-600 text-xs font-bold rounded">PENUH</span>
                                    @else
                                        <span class="px-2 py-1 bg-green-100 text-green-600 text-xs font-bold rounded">TERSEDIA</span>
                                    @endif
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                                    <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ ($kela->member->count() / $kela->kapasitas_maksimum) * 100 }}%"></div>
                                </div>
                            </div>

                            <div>
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Deskripsi</span>
                                <p class="text-sm text-gray-600 mt-1 leading-relaxed">{{ $kela->deskripsi ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: PROGRESS & MEMBER --}}
                <div class="lg:col-span-2 space-y-8">
                    
                    {{-- SECTION: DAFTAR RENCANA LATIHAN (PROGRESS) --}}
                    <section>
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Rencana Latihan (Workout Plan)</h3>
                            @if(auth()->user()->hasPermission('buat_progress'))
                                <a href="{{ route('progress.create', $kela->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2 px-4 rounded-lg shadow-sm transition flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                    Tambah Latihan
                                </a>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @forelse($kemajuan as $progress)
                                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:border-indigo-200 transition">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-bold text-gray-900 text-lg">{{ $progress->nama_latihan }}</h4>
                                        <a href="{{ route('progress.edit', $progress->id) }}" class="text-gray-400 hover:text-indigo-600 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                        </a>
                                    </div>
                                    
                                    <p class="text-sm text-gray-500 mb-3">{{ $progress->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                    
                                    <div class="flex gap-2 mb-3">
                                        <span class="px-2 py-1 bg-blue-50 text-blue-700 text-xs font-semibold rounded">
                                            {{ $progress->jumlah_set }} Set
                                        </span>
                                        <span class="px-2 py-1 bg-purple-50 text-purple-700 text-xs font-semibold rounded">
                                            {{ $progress->jumlah_repetisi }} Reps
                                        </span>
                                    </div>

                                    <div class="text-xs text-gray-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                        Alat: {{ $progress->alat->nama_alat ?? 'Bodyweight' }}
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full text-center py-8 bg-white rounded-xl border border-dashed border-gray-300">
                                    <p class="text-gray-500">Belum ada rencana latihan dibuat.</p>
                                </div>
                            @endforelse
                        </div>
                    </section>

                    {{-- SECTION: DAFTAR MEMBER --}}
                    <section>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Daftar Siswa ({{ $kela->member->count() }})</h3>
                        
                        @if($kela->member && $kela->member->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($kela->member as $member)
                                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm mr-3">
                                                {{ substr($member->nama, 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900 text-sm">{{ $member->nama }}</p>
                                                <p class="text-xs text-gray-500">{{ $member->email }}</p>
                                            </div>
                                        </div>

                                        @if(auth()->user()->hasPermission('nilai_progress_member'))
                                            <a href="{{ route('progressmember.index', ['kelas_id' => $kela->id, 'member_id' => $member->id]) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg text-xs font-semibold transition" title="Nilai Progress">
                                                Lihat Progress
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 bg-white rounded-xl border border-dashed border-gray-300">
                                <p class="text-gray-500">Belum ada member yang bergabung di kelas ini.</p>
                            </div>
                        @endif
                    </section>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>