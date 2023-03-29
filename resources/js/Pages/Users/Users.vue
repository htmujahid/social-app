<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Table from "@/Components/Table/Table.vue";
import THead from "@/Components/Table/THead.vue";
import TBody from "@/Components/Table/TBody.vue";
import Tr from "@/Components/Table/Tr.vue";
import Th from "@/Components/Table/Th.vue";
import Td from "@/Components/Table/Td.vue";

defineProps({
    users: {
        type: Array,
        required: true,
    },
});
</script>
<template>
    <AdminLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <Table>
                        <THead>
                            <Tr>
                                <Th> Name </Th>
                                <Th> Email </Th>
                                <Th> Role </Th>
                                <Th> Posts </Th>
                                <Th> Comments </Th>
                                <Th> Action </Th>
                            </Tr>
                        </THead>
                        <TBody>
                            <template v-for="user in users" :key="user.id">
                                <Tr>
                                    <Td>
                                        {{ user.name }}
                                    </Td>
                                    <Td>
                                        {{ user.email }}
                                    </Td>
                                    <Td>
                                        <!-- {{ user.getRoleNames() }} -->
                                    </Td>
                                    <Td>
                                        <a
                                            :href="
                                                route('admin.posts.index', [
                                                    '_',
                                                    {
                                                        user_id: user.id,
                                                    },
                                                ])
                                            "
                                            class="font-medium text-blue-600 hover:underline"
                                        >
                                            {{ user.posts.length }}
                                        </a>
                                    </Td>
                                    <Td>
                                        <a
                                            :href="
                                                route('admin.comments.index', [
                                                    '_',
                                                    user.id,
                                                ])
                                            "
                                            class="font-medium text-blue-600 hover:underline"
                                        >
                                            {{ user.post_comments.length }}
                                        </a>
                                    </Td>
                                    <Td>
                                        <form
                                            action="{{ route('admin.users.destroy', user.id)}}"
                                            method="post"
                                        >
                                            <button
                                                class="font-medium text-blue-600 hover:underline"
                                                type="submit"
                                            >
                                                Delete
                                            </button>
                                        </form>
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
