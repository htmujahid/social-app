<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <x-table>
                    <x-table.thead>
                        <x-table.tr>
                            <x-table.th>
                                Name
                            </x-table.th>
                            <x-table.th>
                                Email
                            </x-table.th>
                            <x-table.th>
                                Role
                            </x-table.th>
                            <x-table.th>
                                Posts
                            </x-table.th>
                            <x-table.th>
                                Comments
                            </x-table.th>
                            <x-table.th>
                                Action
                            </x-table.th>
                        </x-table.tr>
                    </x-table.thead>
                    <x-table.tbody>
                        @foreach ($users as $user)                            
                            <x-table.tr>
                                <x-table.td>
                                    {{ $user->name }}
                                </x-table.td>
                                <x-table.td>
                                    {{ $user->email }}
                                </x-table.td>
                                <x-table.td>
                                    {{ $user->getRoleNames() }}
                                </x-table.td>
                                <x-table.td>
                                    <a href="{{ route('admin.posts.index', ['user_id' => $user->id]) }}" class="font-medium text-blue-600 hover:underline">
                                        {{ $user->posts->count() }}
                                    </a>
                                </x-table.td>
                                <x-table.td>
                                    <a href="{{ route('admin.comments.index', ['_','user_id' => $user->id]) }}" class="font-medium text-blue-600 hover:underline">
                                        {{ $user->postComments->count() }}
                                    </a>
                                </x-table.td>
                                <x-table.td>
                                    <form action="{{ route('admin.users.destroy', $user->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="font-medium text-blue-600 hover:underline" type="submit">Delete</button>
                                    </form>
                                </x-table.td>
                            </x-table.tr>
                        @endforeach
                    </x-table.tbody> 
                </x-table>
            </div>

        </div>
    </div>
</x-admin-layout>
