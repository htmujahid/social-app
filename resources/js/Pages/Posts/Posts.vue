<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Table from "@/Components/Table/Table.vue";
import THead from "@/Components/Table/THead.vue";
import TBody from "@/Components/Table/TBody.vue";
import Tr from "@/Components/Table/Tr.vue";
import Th from "@/Components/Table/Th.vue";
import Td from "@/Components/Table/Td.vue";
import { Link, useForm } from "@inertiajs/vue3";

defineProps({
    posts: {
        type: Array,
        required: true,
    },
});

const deletePostForm = useForm({});

const deletePost = (id) => {
    deletePostForm.delete(route("admin.posts.destroy", id));
};
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
                            <template v-for="post in posts" :key="post.id">
                                <Tr>
                                    <Td>
                                        {{ post.content }}
                                    </Td>
                                    <Td>
                                        {{ post.user.name }}
                                    </Td>
                                    <Td>
                                        <Link
                                            :href="
                                                route(
                                                    'admin.comments.index',
                                                    post.id
                                                )
                                            "
                                            class="font-medium text-blue-600 hover:underline"
                                            >{{ post.post_comments.length }}
                                        </Link>
                                    </Td>
                                    <Td>
                                        {{ post.post_reacts.length }}
                                    </Td>
                                    <Td>
                                        {{ post.post_stats.length }}
                                    </Td>
                                    <Td>
                                        <button
                                            class="font-medium text-blue-600 hover:underline"
                                            @click="deletePost(post.id)"
                                        >
                                            Delete
                                        </button>
                                    </Td>
                                </Tr>
                            </template>
                        </TBody>
                    </Table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
