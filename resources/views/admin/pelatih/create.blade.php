<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pelatih Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('admin.pelatih.store') }}" method="POST">
                    @csrf

                    {{-- Nama Pelatih --}}
                    <div class="mb-4">
                        <x-input-label for="nama_pelatih" :value="__('Nama Pelatih')" />
                        <x-text-input id="nama_pelatih" class="block mt-1 w-full" type="text" name="nama_pelatih" :value="old('nama_pelatih')" required />
                        <x-input-error :messages="$errors->get('nama_pelatih')" class="mt-2" />
                    </div>

                    {{-- Email (Untuk Login) --}}
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email (Untuk Login)')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password (Untuk Login) --}}
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Spesialisasi --}}
                    <div class="mb-4">
                        <x-input-label for="spesialisasi" :value="__('Spesialisasi (Contoh: Yoga, Cardio)')" />
                        <x-text-input id="spesialisasi" class="block mt-1 w-full" type="text" name="spesialisasi" :value="old('spesialisasi')" />
                        <x-input-error :messages="$errors->get('spesialisasi')" class="mt-2" />
                    </div>

                    {{-- Nomor HP --}}
                    <div class="mb-4">
                        <x-input-label for="nomor_hp" :value="__('Nomor HP')" />
                        <x-text-input id="nomor_hp" class="block mt-1 w-full" type="text" name="nomor_hp" :value="old('nomor_hp')" />
                        <x-input-error :messages="$errors->get('nomor_hp')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.pelatih.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                        <x-primary-button>
                            {{ __('Simpan Pelatih') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>