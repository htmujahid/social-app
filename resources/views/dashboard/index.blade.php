<<<<<<< HEAD
<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="relative overflow-x-auto shadow-md bg-white sm:rounded-lg p-4">
                User of Week: {{ $userOfWeek->name }}
            </div>
            <div class="relative overflow-x-auto shadow-md bg-white sm:rounded-lg p-4">
                Total Users: {{ $users->count() }}                
            </div>
            <div class="relative overflow-x-auto shadow-md bg-white sm:rounded-lg p-4">
                Total Posts: {{ $posts->count() }}           
            </div>
            <div class="relative overflow-x-auto shadow-md bg-white sm:rounded-lg p-4">
                Total Comments: {{ $comments->count() }}
            </div>

        </div>
    </div>
</x-admin-layout>
=======
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
>>>>>>> 041dc94 (views and routes refactoring)
