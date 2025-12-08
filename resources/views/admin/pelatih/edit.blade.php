<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Pelatih: ') . $pelatih->nama_pelatih }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4 dark:text-white">Edit Data Pelatih</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('pelatih.update', $pelatih) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama Pelatih --}}
                        <div class="mb-4">
                            <label for="nama_pelatih" class="block text-sm font-medium text-gray-700">Nama Pelatih</label>
                            <input type="text" name="nama_pelatih" id="nama_pelatih" value="{{ old('nama_pelatih', $pelatih->nama_pelatih) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('nama_pelatih')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        {{-- Spesialisasi --}}
                        <div class="mb-4">
                            <label for="spesialisasi" class="block text-sm font-medium text-gray-700">Spesialisasi</label>
                            <input type="text" name="spesialisasi" id="spesialisasi" value="{{ old('spesialisasi', $pelatih->spesialisasi) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('spesialisasi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        {{-- Tanggal Masuk --}}
                        <div class="mb-4">
                            <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ old('tanggal_masuk', $pelatih->tanggal_masuk) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('tanggal_masuk')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('pelatih.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
