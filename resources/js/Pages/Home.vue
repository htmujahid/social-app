<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import PostCreate from "@/Components/Post/Create.vue";
import PostShow from "@/Components/Post/Show.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    posts: {
        type: Array,
        required: true,
    },
});

defineOptions({
    layout: UserLayout,
});
</script>

<template>
    <Head title="Home" />

    <div
        class="relative bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white"
    >
        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-y-4 p-6 lg:p-8">
            <div>
                <PostCreate />
            </div>
            <template v-for="post in posts" :key="post.id">
                <div>
                    <PostShow
                        :post="post"
                        :current_user_id="$page.props.auth.user.id"
                    />
                </div>
            </template>
        </div>
    </div>
</template>
