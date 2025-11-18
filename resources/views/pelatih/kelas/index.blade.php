<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user()->hasPermission('buat_kelas'))
                <div class="flex justify-end mb-6">
                    <a href="{{ route('kelas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Tambah Kelas Baru
                    </a>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse($kelass as $kelas)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col justify-between">
                        {{-- Bagian Konten Kartu --}}
                        <div class="p-6">
                            <h3 class="font-semibold text-lg text-gray-900">{{ $kelas->nama_kelas }}</h3>
                            <p class="text-sm text-gray-600 mt-1">Oleh: {{ $kelas->pelatih->nama_pelatih ?? 'N/A' }}</p>

                            <div class="mt-4 text-sm text-gray-800 space-y-2">
                                <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($kelas->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($kelas->waktu_selesai)->format('H:i') }}</p>
                                <p><strong>Kapasitas:</strong> {{ $kelas->kapasitas_maksimum }} orang</p>
                                <p class="text-gray-500 mt-2">{{ $kelas->deskripsi }}</p>
                            </div>
                        </div>

                        {{-- Bagian Tombol Aksi (Footer Kartu) --}}
                        <div class="p-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end space-x-3">
                            <a href="{{ route('kelas.show', $kelas->id) }}" class="text-sm text-blue-600 hover:text-blue-900">Lihat</a>
                            @if(auth()->user()->hasPermission('ubah_kelas'))
                                <a href="{{ route('kelas.edit', $kelas) }}" class="text-sm text-indigo-600 hover:text-indigo-900">Edit</a>
                            @endif
                            @if(auth()->user()->hasPermission('hapus_kelas'))
                                <form action="{{ route('kelas.destroy', $kelas) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus kelas ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <p class="text-center text-gray-500 py-10">Belum ada kelas tersedia.</p>
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</x-app-layout>
