<script setup>
import UpvoteIcon from "../Icons/Upvote.vue";
import DownvoteIcon from "../Icons/Downvote.vue";
import DeleteIcon from "../Icons/Delete.vue";
import axios from "axios";
import { defineComponent, reactive, ref } from "vue";

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
    upvoteCount: getUpvote().length,
    downvoteCount: getDownvote().length,
    isUpvoted: isUpvoted(),
    isDownvoted: isDownvoted(),
    user_media_path: getUserMediaPath(),
    ...props.comment,
});

function getUpvote() {
    return props.comment.post_comment_reacts.filter(
        (react) => react.type === "upvote"
    );
}

function getDownvote() {
    return props.comment.post_comment_reacts.filter(
        (react) => react.type === "downvote"
    );
}

function isUpvoted() {
    return props.comment.post_comment_reacts.filter(
        (react) =>
            react.type === "upvote" && react.user_id === props.current_user_id
    ).length;
}

function isDownvoted() {
    return props.comment.post_comment_reacts.filter(
        (react) =>
            react.type === "downvote" && react.user_id === props.current_user_id
    ).length;
}

function getUserMediaPath() {
    return props.comment.user.user_media[0]
        ? props.comment.user.user_media[0].path
        : "users/default.jpg";
}

function upvote() {
    if (comment.isUpvoted) {
        axios
            .delete(`/comments/${comment.id}/react`)
            .then(() => {
                comment.upvoteCount--;
            })
            .catch((error) => {
                console.log(error);
            });
    } else {
        axios
            .post(`/comments/${comment.id}/react`, {
                type: "upvote",
            })
            .then(() => {
                if (comment.isDownvoted) {
                    comment.downvoteCount--;
                }
                comment.isDownvoted = false;
                comment.upvoteCount++;
            })
            .catch((error) => {
                console.log(error);
            });
    }
    comment.isUpvoted = !comment.isUpvoted;
}

function downvote() {
    if (comment.isDownvoted) {
        axios
            .delete(`/comments/${comment.id}/react`)
            .then(() => {
                comment.downvoteCount--;
            })
            .catch((error) => {
                console.log(error);
            });
    } else {
        axios
            .post(`/comments/${comment.id}/react`, {
                type: "downvote",
            })
            .then(() => {
                if (comment.isUpvoted) {
                    comment.upvoteCount--;
                }
                comment.isUpvoted = false;
                comment.downvoteCount++;
            })
            .catch((error) => {
                console.log(error);
            });
    }
    comment.isDownvoted = !comment.isDownvoted;
}

function deleteComment() {
    axios
        .delete(`/posts/${props.post_id}/comments/${comment.id}`)
        .then(() => {
            window.location.reload();
        })
        .catch((error) => {
            console.log(error);
        });
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
                class="absolute -bottom-1 -left-2"
                @click="deleteComment"
                v-show="showDeleteButton && comment.user_id === current_user_id"
            >
                <DeleteIcon />
            </button>
        </div>
    </div>
</template>
