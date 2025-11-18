<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kelas: ') . $kela->nama_kelas }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('kelas.update', $kela) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama Kelas --}}
                        <div class="mb-4">
                            <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                            <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas', $kela->nama_kelas) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('nama_kelas')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        {{-- Dropdown Pelatih --}}
                        <div class="mb-4">
                            <label for="pelatih_id" class="block text-sm font-medium text-gray-700">Pilih Pelatih</label>
                            <select name="pelatih_id" id="pelatih_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                @foreach ($pelatihs as $pelatih)
                                    <option value="{{ $pelatih->id }}" {{ old('pelatih_id', $kela->pelatih_id) == $pelatih->id ? 'selected' : '' }}>
                                        {{ $pelatih->nama_pelatih }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pelatih_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        {{-- Waktu Mulai & Selesai --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                                <input type="time" name="waktu_mulai" id="waktu_mulai" value="{{ old('waktu_mulai', $kela->waktu_mulai) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                @error('waktu_mulai')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                                <input type="time" name="waktu_selesai" id="waktu_selesai" value="{{ old('waktu_selesai', $kela->waktu_selesai) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                @error('waktu_selesai')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        {{-- Kapasitas Maksimum --}}
                        <div class="mb-4">
                            <label for="kapasitas_maksimum" class="block text-sm font-medium text-gray-700">Kapasitas Maksimum (Orang)</label>
                            <input type="number" name="kapasitas_maksimum" id="kapasitas_maksimum" value="{{ old('kapasitas_maksimum', $kela->kapasitas_maksimum) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required min="1">
                            @error('kapasitas_maksimum')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('deskripsi', $kela->deskripsi) }}</textarea>
                            @error('deskripsi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('kelas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
