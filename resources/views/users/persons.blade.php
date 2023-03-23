<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Persons') }}
        </h2>
    </x-slot>
    <div class="relative bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-y-4 p-6 lg:p-8">
            {{-- if current route is persons.index then show --}}
            @if (Route::currentRouteName() == 'persons.index')
                <div class="flex">
                    <a href="{{route('persons.pending')}}" class="underline text-blue-500">Here</a><pre> </pre>are the pending persons.
                </div>
            @endif
            @forelse ($persons as $person)
                <div>
                    <v-person
                        :person="{{ json_encode($person) }}"
                        person_type="{{ Route::currentRouteName() == 'persons.index' ? '': 'cancel' }}"
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