<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-200">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-white"/>
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full bg-gray-200 text-gray-900" autocomplete="current-password" />
            <x-input-error class="mt-2 text-white" :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-white"/>
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full bg-gray-200 text-gray-900" autocomplete="new-password" />
            <x-input-error class="mt-2 text-white" :messages="$errors->updatePassword->get('password')" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-white"/>
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-gray-200 text-gray-900" autocomplete="new-password" />
            <x-input-error class="mt-2 text-white" :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-200">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
