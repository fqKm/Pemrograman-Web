@extends('layouts.admin')

@section('content')
    <div class="pt-32 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        {{-- Judul halaman --}}
        <h1 class="text-2xl font-bold text-gray-800">
            Settings
        </h1>

        {{-- Update Profile Information --}}
        <div class="p-4 sm:p-8 bg-indigo-600 shadow sm:rounded-lg text-white dark">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Update Password --}}
        <div class="p-4 sm:p-8 bg-indigo-600 shadow sm:rounded-lg text-white">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Delete Account --}}
        <div class="p-4 sm:p-8 bg-indigo-600 shadow sm:rounded-lg text-white">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
