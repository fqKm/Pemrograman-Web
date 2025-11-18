<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kelas: ') . $kela->nama_kelas }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Back Button --}}
            <div class="flex justify-end mb-4">
                <a href="{{ route('kelas.index') }}" class="text-blue-500 hover:text-blue-700">
                    &larr; Kembali ke Daftar Kelas
                </a>
            </div>

            {{-- Detail Kelas --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
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
                            <span class="text-sm text-gray-500">Waktu</span>
                            <p class="font-medium text-gray-800">
                                {{ \Carbon\Carbon::parse($kela->waktu_mulai)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($kela->waktu_selesai)->format('H:i') }}
                            </p>
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

                    {{-- Tombol Edit --}}
                    <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end">
                        <a href="{{ route('kelas.edit', $kela) }}"
                           class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Edit Kelas Ini
                        </a>
                    </div>
                </div>
            </div>

            {{-- SECTION: Progress Kelas --}}
            <h2 class="font-semibold text-xl text-white leading-tight mb-4">
                Daftar Progress Kelas
            </h2>

            @if(auth()->user()->hasPermission('buat_progress'))
                <div class="flex justify-end mb-6">
                    <a href="{{ route('progress.create', $kela->id) }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Tambah Progress Baru
                    </a>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-10">
                @forelse($kemajuan as $progress)
                    <div class="bg-white shadow-sm sm:rounded-lg flex flex-col justify-between mt-4">
                        <div class="p-6">
                            <h3 class="font-semibold text-lg text-gray-900">
                                {{ $progress->nama_latihan }}
                            </h3>

                            <p class="text-sm text-gray-600 mt-1">
                                Alat dibutuhkan: {{ $progress->alat->nama_alat ?? 'Tidak membutuhkan alat' }}
                            </p>

                            <div class="mt-4 text-sm text-gray-800 space-y-1">
                                <p><strong>Set:</strong> {{ $progress->jumlah_set }}</p>
                                <p><strong>Repetisi:</strong> {{ $progress->jumlah_repetisi }}</p>
                                <p><strong>Deskripsi:</strong> {{ $progress->deskripsi ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end mb-6 mr-6">
                            <a href="{{ route('progress.edit', $progress->id) }}"
                               class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Edit Progress Ini
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-10">Belum ada progress.</p>
                @endforelse
            </div>

            {{-- SECTION: Daftar Member --}}
            <h2 class="font-semibold text-xl text-white leading-tight mb-4">
                Daftar Member yang Mengikuti Kelas Ini
            </h2>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($kela->member && $kela->member->count() > 0)
                    <ul class="divide-y divide-gray-200">
                        @foreach($kela->member as $member)
                            <li class="p-4 flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $member->nama }}</p>
                                    <p class="text-sm text-gray-600">Email: {{ $member->email }}</p>
                                    <p class="text-sm text-gray-600">No HP: {{ $member->no_hp }}</p>
                                </div>

                                <div class="flex space-x-2">
{{--                                    <a href="{{ route('member.show', $member->id) }}"--}}
{{--                                       class="bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm px-3 py-2 rounded">--}}
{{--                                        Detail--}}
{{--                                    </a>--}}

                                    @if(auth()->user()->hasPermission('nilai_progress_member'))
                                        <a href="{{ route('progressmember.index', ['kelas_id' => $kela->id, 'member_id' => $member->id]) }}"
                                           class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-2 rounded">
                                            Progress
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center text-gray-500 py-6">Belum ada member yang ikut kelas ini.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
