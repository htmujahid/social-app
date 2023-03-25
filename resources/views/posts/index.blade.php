<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <x-table>
                    <x-table.thead>
                        <x-table.tr>
                            <x-table.th>
                                Content
                            </x-table.th>
                            <x-table.th>
                                User
                            </x-table.th>
                            <x-table.th>
                                Comments
                            </x-table.th>
                            <x-table.th>
                                Reacts
                            </x-table.th>
                            <x-table.th>
                                Stats
                            </x-table.th>
                            <x-table.th>
                                Action
                            </x-table.th>
                        </x-table.tr>
                    </x-table.thead>
                    <x-table.tbody>
                        @foreach ($posts as $post)                            
                            <x-table.tr>
                                <x-table.td>
                                    {{ $post->content }}
                                </x-table.td>
                                <x-table.td>
                                    {{ $post->user->name }}
                                </x-table.td>
                                <x-table.td>
                                    <a href="{{ route('admin.comments.index', $post->id) }}" class="font-medium text-blue-600 hover:underline">{{ $post->postComments->count() }}</a>
                                </x-table.td>
                                <x-table.td>
                                    {{ $post->postReacts->count() }}
                                </x-table.td>
                                <x-table.td>
                                    {{ $post->postStats->count() }}
                                </x-table.td>
                                <x-table.td>
                                    <form action="{{ route('admin.posts.destroy', $post->id)}}" method="post">
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
