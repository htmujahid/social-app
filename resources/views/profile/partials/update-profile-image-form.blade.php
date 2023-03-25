<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Image') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile image.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.updateImage') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div id="user-media-preview"></div>

        <div>
            <x-input.label for="photo" :value="__('Photo')" />
            <x-input.index id="user-media" name="user-media" type="file" accept="image/*" class="mt-1 block w-full p-2 border" />
            <x-input.error class="mt-2" :messages="$errors->get('user-media')" />
        </div>

        <div class="flex items-center gap-4">
            <x-button.primary>{{ __('Save') }}</x-button.primary>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>