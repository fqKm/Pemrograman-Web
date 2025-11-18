<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Progress Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('progress.store') }}" method="POST">
                        @csrf
                            <input type="number" name="kelas_id" id="kelas_id" value="{{ $kelas->id }}" hidden="hidden">
                            @error('kelas_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        {{-- Nama Progress --}}
                        <div class="mb-4">
                            <label for="nama_latihan" class="block text-sm font-medium text-gray-700">Nama Progress</label>
                            <input type="text" name="nama_latihan" id="nama_latihan" value="{{ old('nama_latihan') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('nama_latihan')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        {{-- Dropdown Alat --}}
                        <div class="mb-4">
                            <label for="alat_id" class="block text-sm font-medium text-gray-700">Pilih Alat</label>
                            <select name="alat_id" id="alat_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">-- Pilih Alat --</option>
                                @foreach ($alat as $data_alat)
                                    <option value="{{ $data_alat->id }}" {{ old('alat_id') == $data_alat->id ? 'selected' : '' }}>
                                        {{ $data_alat->nama_alat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('alat_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        {{-- Kapasitas Maksimum --}}
                        <div class="mb-4">
                            <label for="jumlah_set" class="block text-sm font-medium text-gray-700">Jumlah Set</label>
                            <input type="number" name="jumlah_set" id="jumlah_set" value="{{ old('jumlah_set') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required min="1">
                            @error('jumlah_set')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="jumlah_repetisi" class="block text-sm font-medium text-gray-700">Jumlah Repetisi</label>
                            <input type="number" name="jumlah_repetisi" id="jumlah_repetisi" value="{{ old('jumlah_set') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required min="1">
                            @error('jumlah_repetisi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('kelas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
