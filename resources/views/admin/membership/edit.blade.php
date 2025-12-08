<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Membership: ') . $membership->nama_plan }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4 dark:text-white">Edit Data Membership</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('membership.update', $membership) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nama_plan" class="block text-sm font-medium text-gray-700">Nama Membership</label>
                            <input type="text" name="nama_plan" id="nama_plan" value="{{ old('nama_plan', $membership->nama_plan )}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('nama_plan')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                            <input type="text" name="harga" id="harga" value="{{ old('harga', $membership->harga) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('harga')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="durasi" class="block text-sm font-medium text-gray-700">Durasi</label>
                            <input type="number" name="durasi" id="durasi" value="{{ old('durasi', $membership->durasi) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('durasi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi', $membership->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('membership.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
