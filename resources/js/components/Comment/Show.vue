<script setup>
import UpvoteIcon from "@/Components/Icons/Upvote.vue";
import DownvoteIcon from "@/Components/Icons/Downvote.vue";
import DeleteIcon from "@/Components/Icons/Delete.vue";
import { defineComponent, reactive, ref } from "vue";
import {
    getUpvoteCount,
    getDownvoteCount,
    isUpvoted,
    isDownvoted,
} from "@/Setup/Comment/utils";
import { getUserMediaPath } from "@/Setup/User/utils";
import { useForm } from "@inertiajs/vue3";

defineComponent({
    components: {
        UpvoteIcon,
        DownvoteIcon,
        DeleteIcon,
    },
});

const props = defineProps({
    comment: {
        type: Object,
        required: true,
    },
    current_user_id: {
        type: Number,
        required: true,
    },
    post_id: {
        type: Number,
        required: true,
    },
});

const showDeleteButton = ref(false);

const comment = reactive({
    upvoteCount: getUpvoteCount(props.comment.post_comment_reacts),
    downvoteCount: getDownvoteCount(props.comment.post_comment_reacts),
    isUpvoted: isUpvoted(
        props.comment.post_comment_reacts,
        props.current_user_id
    ),
    isDownvoted: isDownvoted(
        props.comment.post_comment_reacts,
        props.current_user_id
    ),
    user_media_path: getUserMediaPath(props.comment.user),
    ...props.comment,
});

const upvoteForm = useForm({
    type: "upvote",
});

const downvoteForm = useForm({
    type: "downvote",
});

const unvoteForm = useForm({});

const deleteCommentForm = useForm({});

function upvote() {
    if (comment.isUpvoted) {
        unvoteForm.delete(route("comments.unreact", comment.id), {
            preserveScroll: true,
            onSuccess: () => comment.upvoteCount--,
        });
    } else {
        if (comment.isDownvoted) {
            comment.isDownvoted = false;
            comment.downvoteCount--;
        }
        upvoteForm.post(route("comments.react", comment.id), {
            preserveScroll: true,
            onSuccess: () => comment.upvoteCount++,
        });
    }
    comment.isUpvoted = !comment.isUpvoted;
}

function downvote() {
    if (comment.isDownvoted) {
        unvoteForm.delete(route("comments.unreact", comment.id), {
            preserveScroll: true,
            onSuccess: () => comment.downvoteCount--,
        });
    } else {
        if (comment.isUpvoted) {
            comment.upvoteCount--;
            comment.isUpvoted = false;
        }
        downvoteForm.post(route("comments.react", comment.id), {
            preserveScroll: true,
            onSuccess: () => comment.downvoteCount++,
        });
    }
    comment.isDownvoted = !comment.isDownvoted;
}

function deleteComment() {
    deleteCommentForm.delete(
        route("comments.destroy", [props.post_id, comment.id], {
            preserveScroll: true,
        })
    );
}
</script>

<template>
    <div
        class="flex gap-2 w-fit"
        @mouseenter="showDeleteButton = true"
        @mouseleave="showDeleteButton = false"
    >
        <div class="flex flex-col text-gray-500">
            <button class="" @click="upvote">
                <UpvoteIcon :active="!!comment.isUpvoted" />
            </button>
            <p class="text-center">
                {{ comment.upvoteCount }}/{{ comment.downvoteCount }}
            </p>
            <button class="" @click="downvote">
                <DownvoteIcon :active="!!comment.isDownvoted" />
            </button>
        </div>
        <div class="rounded-lg bg-gray-100 p-2 relative">
            <div class="flex gap-2 items-start space-x-2">
                <img
                    :src="'/storage/' + comment.user_media_path"
                    alt="User avatar"
                    class="h-9 w-9 rounded-full bg-gray-300 object-cover"
                />
                <div class="">
                    <p class="font-medium text-sm">
                        {{ comment.user.name }}
                    </p>
                    <p class="text-xs text-gray-700">
                        {{ new Date(comment.created_at).toDateString() }}
                    </p>
                </div>
            </div>
            <div class="pt-2">
                <p class="text-gray-800 text-sm">
                    {{ comment.content }}
                </p>
            </div>
            <button
                @click="deleteComment"
                v-show="showDeleteButton && comment.user_id === current_user_id"
                class="absolute -bottom-1 -left-2"
            >
                <DeleteIcon />
            </button>
        </div>
    </div>
</template>
