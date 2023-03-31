<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import PostShow from "@/Components/Post/Show.vue";

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
    <div
        class="relative bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white"
    >
        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-y-4 p-6 lg:p-8">
            <template v-for="post in posts" :key="post.id">
                <div>
                    <PostShow
                        :post="post"
                        :comments="post.post_comments"
                        :current_user_id="$page.props.auth.user.id"
                    />
                </div>
            </template>
        </div>
    </div>
</template>
