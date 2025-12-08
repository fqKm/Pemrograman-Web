<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Flash Message --}}
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- 1. KELAS SAYA --}}
            <section>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Kelas Saya</h3>
                @if($myClasses->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($myClasses as $kelas)
                            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-indigo-500">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-bold text-lg">{{ $kelas->nama_kelas }}</h4>
                                    <span class="bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded-full font-bold">JOINED</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-4">
                                    <span class="block">📅 {{ \Carbon\Carbon::parse($kelas->waktu_mulai)->format('l, d M Y') }}</span>
                                    <span class="block">⏰ {{ \Carbon\Carbon::parse($kelas->waktu_mulai)->format('H:i') }} WIB</span>
                                    <span class="block">👤 {{ $kelas->pelatih->nama_pelatih ?? 'TBA' }}</span>
                                </p>
                                <a href="{{ route('members.kelas.show', $kelas->id) }}" class="block text-center w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded transition">
                                    Lihat Detail
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic">Anda belum bergabung di kelas manapun.</p>
                @endif
            </section>

            {{-- 2. KELAS TERSEDIA --}}
            <section>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Kelas Tersedia</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($availableClasses as $kelas)
                        <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100">
                            <div class="flex justify-between items-start mb-3">
                                <h4 class="font-bold text-lg">{{ $kelas->nama_kelas }}</h4>
                                @if($kelas->member_count >= $kelas->kapasitas_maksimum)
                                    <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full font-bold">FULL</span>
                                @else
                                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-bold">OPEN</span>
                                @endif
                            </div>
                            
                            <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $kelas->deskripsi }}</p>
                            
                            <div class="text-sm text-gray-600 space-y-1 mb-6">
                                <p>📅 {{ \Carbon\Carbon::parse($kelas->waktu_mulai)->format('l, d M Y') }}</p>
                                <p>⏰ {{ \Carbon\Carbon::parse($kelas->waktu_mulai)->format('H:i') }} WIB</p>
                                <p>👥 Kapasitas: {{ $kelas->member_count }}/{{ $kelas->kapasitas_maksimum }}</p>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('members.kelas.show', $kelas->id) }}" class="flex-1 bg-white border border-gray-300 text-gray-700 font-semibold py-2 px-4 rounded text-center hover:bg-gray-50">
                                    Detail
                                </a>
                                
                                @if($kelas->member_count < $kelas->kapasitas_maksimum)
                                    <form action="{{ route('members.kelas.join', $kelas->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition">
                                            Join
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="flex-1 bg-gray-200 text-gray-400 font-semibold py-2 px-4 rounded cursor-not-allowed">
                                        Penuh
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
    </div>
</x-app-layout>