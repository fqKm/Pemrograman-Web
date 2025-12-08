<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Alat Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4 dark:text-white">Tambah Alat Baru</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('alat.store') }}" method="POST">
                        @csrf
                        {{-- Nama Alat --}}
                        <div class="mb-4">
                            <label for="nama_alat" class="block text-sm font-medium text-gray-700">Nama Alat</label>
                            <input type="text" name="nama_alat" id="nama_alat" value="{{ old('nama_alat') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('nama_kelas')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        {{-- Jumlah Alat --}}
                        <div class="mb-4">
                            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Alat</label>
                            <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required min="1">
                            @error('jumlah')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_pembelian" class="block text-sm font-medium text-gray-700">Tanggal Pembelian</label>
                            <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" value="{{ old('tanggal_pembelian') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('tanggal_pembelian')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('alat.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
