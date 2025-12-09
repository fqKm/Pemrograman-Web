<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pelatih') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- 1. Welcome Banner --}}
            <div class="relative bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-xl p-8 text-white overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <h1 class="text-3xl font-extrabold mb-2">Selamat Datang, {{ $pelatih->nama_pelatih }}! 🏋️‍♂️</h1>
                        <p class="text-blue-100 text-lg">Kelola kelas, pantau perkembangan siswa, dan atur jadwal latihan Anda dengan mudah.</p>
                    </div>
                    <div class="hidden md:block opacity-80">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                </div>
                {{-- Decorative Circles --}}
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
            </div>

            {{-- 2. Stats Overview --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-lg mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Kelas</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $kelas->count() }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 bg-green-100 text-green-600 rounded-lg mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Siswa Aktif</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $members->count() }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 bg-orange-100 text-orange-600 rounded-lg mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Jadwal Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $kelas->where('hari', now()->dayOfWeekIso)->count() }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- 3. Kelas Anda (Your Class) --}}
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Kelas Anda</h2>
                    {{-- <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Lihat Semua</a> --}}
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($kelas as $kelas_data)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300 flex flex-col h-full overflow-hidden">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-bold text-gray-900 line-clamp-1" title="{{ $kelas_data->nama_kelas }}">
                                        {{ $kelas_data->nama_kelas }}
                                    </h3>
                                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-bold uppercase tracking-wide">
                                        Ongoing
                                    </span>
                                </div>
                                
                                <div class="space-y-3 mb-6">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                        <span class="font-medium">{{ $kelas_data->member->count() }} Siswa Bergabung</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>
                                            {{ \Carbon\Carbon::parse($kelas_data->waktu_mulai)->format('H:i') }} - 
                                            {{ \Carbon\Carbon::parse($kelas_data->waktu_selesai)->format('H:i') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-auto bg-gray-50 px-6 py-4 border-t border-gray-100">
                                <a href="{{ route('kelas.show', $kelas_data->id) }}" class="block w-full text-center bg-white border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white font-semibold py-2 px-4 rounded-lg transition duration-200 shadow-sm">
                                    Kelola Kelas
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center bg-white rounded-xl border border-dashed border-gray-300">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <p class="text-gray-500 font-medium">Belum ada kelas yang Anda ampu.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- 4. Your Students --}}
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Siswa Anda</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($members as $member)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition duration-300">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="flex-shrink-0 h-12 w-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold text-lg">
                                    {{ substr($member->nama, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900 line-clamp-1">{{ $member->nama }}</h4>
                                    <p class="text-xs text-gray-500">ID: #{{ $member->id }}</p>
                                </div>
                            </div>
                            
                            <div class="space-y-2 border-t border-gray-50 pt-3">
                                <p class="text-xs text-gray-400 uppercase font-semibold">Kelas yang diikuti:</p>
                                <div class="flex flex-wrap gap-2">
                                    @forelse($member->kelas as $kelas_member)
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-700">
                                            {{ $kelas_member->nama_kelas }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-400 italic">Belum ada kelas</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center bg-white rounded-xl border border-dashed border-gray-300">
                            <p class="text-gray-500 font-medium">Belum ada siswa yang bergabung di kelas Anda.</p>
                        </div>
                    @endforelse
                </div>
            </section>

        </div>
    </div>
</x-app-layout>