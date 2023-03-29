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
                                <Th> Comments </Th>
                                <Th> Reacts </Th>
                                <Th> Stats </Th>
                                <Th> Action </Th>
                            </Tr>
                        </THead>
                        <TBody>
                            <!-- @foreach ($posts as $post) -->
                            <Tr>
                                <Td>
                                    {{ $post->content }}
                                </Td>
                                <Td>
                                    {{ $post->user->name }}
                                </Td>
                                <Td>
                                    <a
                                        href="{{ route('admin.comments.index', $post->id) }}"
                                        class="font-medium text-blue-600 hover:underline"
                                        >{{ $post->postComments->count() }}</a
                                    >
                                </Td>
                                <Td>
                                    {{ $post->postReacts->count() }}
                                </Td>
                                <Td>
                                    {{ $post->postStats->count() }}
                                </Td>
                                <Td>
                                    <form
                                        action="{{ route('admin.posts.destroy', $post->id)}}"
                                        method="post"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            class="font-medium text-blue-600 hover:underline"
                                            type="submit"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </Td>
                            </Tr>
                            <!-- @endforeach -->
                        </TBody>
                    </Table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
