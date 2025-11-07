<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tambah Pelatih Baru') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('membership.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_plan" class="block text-sm font-medium text-gray-700">Nama Membership</label>
                            <input type="text" name="nama_plan" id="nama_plan" value="{{ old('nama_plan') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('nama_plan')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                            <input type="text" name="harga" id="harga" value="{{ old('harga') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('harga')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ old('tanggal_masuk') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('tanggal_masuk')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('pelatih.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
