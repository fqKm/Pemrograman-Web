<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Alat Gym') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user()->hasPermission('tambah_alat'))
                <div class="flex items-center justify-end mb-4">
                    <div class="w-1/2  p-4">
                        <h2 class="text-2xl font-semibold dark:text-white text-gray-900 ">Daftar Alat</h2>
                    </div>
                    <div class="w-1/2 items-center p-4 text-right">
                        <!-- <h1 class="text-2xl font-semibold text-gray-800">Daftar Member</h1> -->
                        <a href="{{ route('alat.create') }}"
                        class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            + Tambah Alat Baru
                        </a>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="bg-red-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse($alat as $data_alat)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col justify-between">
                        {{-- Bagian Konten Kartu --}}
                        <div class="p-6">
                            <h3 class="font-semibold text-lg text-gray-900">{{ $data_alat->nama_alat }}</h3>
                            <p class="text-sm text-gray-600 mt-1">Jumlah: {{ $data_alat->jumlah ?? '0' }}</p>
                            @if($data_alat->terpakai > 0)
                                <p class="text-sm text-green-600 mt-1">Terpakai : {{ $data_alat->terpakai}}</p>
                            @elseif($data_alat->terpakai < 0)
                                <p class="text-sm text-red-600 mt-1">Terpakai : {{ $data_alat->terpakai}}</p>
                            @endif
                            <div class="mt-4 text-sm text-gray-800 space-y-2">
                                <p>
                                    <strong>Tanggal Pembelian</strong> {{ \Carbon\Carbon::parse($data_alat->tanggal_pembelian)->format('d F Y') }}</p>
                            </div>
                        </div>

                        {{-- Bagian Tombol Aksi (Footer Kartu) --}}
                        <div class="p-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end space-x-3">
                            @if(auth()->user()->hasPermission('ubah_alat'))
                                <a href="{{ route('alat.edit', $data_alat->id) }}"
                                   class="text-sm text-indigo-600 hover:text-indigo-900">Edit</a>
                            @endif
                            @if(auth()->user()->hasPermission('hapus_alat'))
                                <form action="{{ route('alat.destroy', $data_alat->id) }}" method="POST"
                                      onsubmit="return confirm('Anda yakin ingin menghapus alat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <p class="text-center text-gray-500 py-10">Belum ada alat tersedia.</p>
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</x-app-layout>
