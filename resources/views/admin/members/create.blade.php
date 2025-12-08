<x-app-layout>
    {{-- Slot untuk header (opsional, tapi sering ada) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Member') }}
        </h2>
    </x-slot>


<div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Member Baru</h1>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <form action="{{ route('admin.members.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    @error('nama')<p class="mt- 1 text-sm text-red-600">{{ $message }}</p>@enderror </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label for="nomor_hp" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                    <input type="text" name="nomor_hp" id="nomor_hp" value="{{ old('nomor_hp') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @error('nomor_hp')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    @error('tanggal_lahir')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label for="tanggal_bergabung" class="block text-sm font-medium text-gray-700">Tanggal Bergabung</label>
                    <input type="date" name="tanggal_bergabung" id="tanggal_bergabung" value="{{ old('tanggal_bergabung') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    @error('tanggal_bergabung')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label for="membership_id" class="block text-sm font-medium text-gray-700">Paket Membership</label>
                    <select name="membership_id" id="membership_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    <option value="">Pilih Paket</option>
                    @foreach ($memberships as $paket)
                    <option value="{{ $paket->id }}" {{ old('membership_id') == $paket->id ? 'selected' : '' }}>
                    {{ $paket->nama_plan }}
                    </option>
                    @endforeach
                </select>
                    @error('membership_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ old('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('admin.members.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
