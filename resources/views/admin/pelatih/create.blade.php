<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tambah Pelatih Baru') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.pelatih.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_pelatih" class="block text-sm font-medium text-gray-700">Nama Pelatih</label>
                            <input type="text" name="nama_pelatih" id="nama_pelatih" value="{{ old('nama_pelatih') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('nama_pelatih')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="spesialisasi" class="block text-sm font-medium text-gray-700">Spesialisasi</label>
                            <input type="text" name="spesialisasi" id="spesialisasi" value="{{ old('spesialisasi') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('spesialisasi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ old('tanggal_masuk') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('tanggal_masuk')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.pelatih.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
