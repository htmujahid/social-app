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
                                Post ID
                            </x-table.th>
                            <x-table.th>
                                Upvotes / Downvotes
                            </x-table.th>
                            <x-table.th>
                                Action
                            </x-table.th>
                        </x-table.tr>
                    </x-table.thead>
                    <x-table.tbody>
                        @foreach ($comments as $comment)                            
                            <x-table.tr>
                                <x-table.td>
                                    {{ $comment->content }}
                                </x-table.td>
                                <x-table.td>
                                    {{ $comment->user->name }}
                                </x-table.td>
                                <x-table.td>
                                    {{ $comment->post->id }}
                                </x-table.td>
                                <x-table.td>
                                    {{ $comment->postCommentReacts->where('type', 'upvote')->count() }} / {{ $comment->postCommentReacts->where('type', 'downvote')->count() }}
                                </x-table.td>
                                <x-table.td>
                                    <form action="{{ route('admin.comments.destroy', ['_', $comment->id])}}" method="post">
                                        @csrf
                                        @method('delete')
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
