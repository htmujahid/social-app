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
