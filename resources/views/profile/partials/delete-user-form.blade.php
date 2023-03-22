<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

<<<<<<< HEAD
    <x-button.danger id="delete-user-button">{{ __('Delete Account') }}</x-button.danger>
=======
    <x-button.danger
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-button.danger>
>>>>>>> 041dc94 (views and routes refactoring)

    <x-modal.index name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable :messages="$errors->userDeletion->get('password')">
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input.label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-input.index
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Password') }}"
                />

                <x-input.error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
<<<<<<< HEAD
                <x-button.secondary id="cancel-user-deletion-button">
                    {{ __('Cancel') }}
                </x-button.secondary>

                <x-button.danger class="ml-3" >
=======
                <x-button.secondary x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-button.secondary>

                <x-button.danger class="ml-3">
>>>>>>> 041dc94 (views and routes refactoring)
                    {{ __('Delete Account') }}
                </x-button.danger>
            </div>
        </form>
    </x-modal.index>
</section>
