<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Table from "@/Components/Table/Table.vue";
import THead from "@/Components/Table/THead.vue";
import TBody from "@/Components/Table/TBody.vue";
import Tr from "@/Components/Table/Tr.vue";
import Th from "@/Components/Table/Th.vue";
import Td from "@/Components/Table/Td.vue";
</script>
<template>
    <AdminLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <Table>
                        <THead>
                            <Tr>
                                <Th> Content </Th>
                                <Th> User </Th>
                                <Th> Post ID </Th>
                                <Th> Upvotes / Downvotes </Th>
                                <Th> Action </Th>
                            </Tr>
                        </THead>
                        <TBody>
                            @foreach ($comments as $comment)
                            <Tr>
                                <Td>
                                    {{ $comment->content }}
                                </Td>
                                <Td>
                                    {{ $comment->user->name }}
                                </Td>
                                <Td>
                                    {{ $comment->post->id }}
                                </Td>
                                <Td>
                                    {{ $comment->postCommentReacts->where('type', 'upvote')->count() }}
                                    /
                                    {{ $comment->postCommentReacts->where('type', 'downvote')->count() }}
                                </Td>
                                <Td>
                                    <form
                                        action="{{ route('admin.comments.destroy', ['_', $comment->id])}}"
                                        method="post"
                                    >
                                        @csrf @method('delete')
                                        <button
                                            class="font-medium text-blue-600 hover:underline"
                                            type="submit"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </Td>
                            </Tr>
                            @endforeach
                        </TBody>
                    </Table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
