<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Table from "@/Components/Table/Table.vue";
import THead from "@/Components/Table/THead.vue";
import TBody from "@/Components/Table/TBody.vue";
import Tr from "@/Components/Table/Tr.vue";
import Th from "@/Components/Table/Th.vue";
import Td from "@/Components/Table/Td.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
    comments: {
        type: Object,
        required: true,
    },
});

defineOptions({
    layout: AdminLayout,
});

const deleteCommentForm = useForm({});

const deleteComment = (postId, id) => {
    deleteCommentForm.delete(route("admin.comments.destroy", [postId, id]));
};
</script>
<template>
    <Head title="Comments" />

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
                        <template v-for="comment in comments" :key="comment.id">
                            <Tr>
                                <Td>
                                    {{ comment.content }}
                                </Td>
                                <Td>
                                    {{ comment.user.name }}
                                </Td>
                                <Td>
                                    {{ comment.post.id }}
                                </Td>
                                <Td>
                                    {{ comment.post_comment_upvotes.length }}
                                    /
                                    {{ comment.post_comment_downvotes.length }}
                                </Td>
                                <Td>
                                    <button
                                        class="font-medium text-blue-600 hover:underline"
                                        @click="
                                            deleteComment(
                                                comment.post.id,
                                                comment.id
                                            )
                                        "
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
</template>
