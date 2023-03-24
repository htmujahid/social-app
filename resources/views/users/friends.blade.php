<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Friends') }}
        </h2>
    </x-slot>
    <div class="relative bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-y-4 p-6 lg:p-8">
            @if (Route::currentRouteName() == 'friends.index')
                <div class="flex">
                    <a href="{{route('friends.pending-requests')}}" class="underline text-blue-500">Here</a><pre> </pre>are the unresponsed friend requests.
                </div>
            @endif
            @forelse ($friends as $friend)
                <div>
                    <v-friend 
                        :friend="{{ json_encode($friend) }}"
                        friend_type="{{ Route::currentRouteName() == 'friends.index' ? '': 'confirm' }}"
                    />
                </div>
           @empty 
                <div class="text-center">
                    <p class="text-gray-500">No Record Found.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-user-layout>