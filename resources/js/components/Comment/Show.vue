<template>
    <div class="flex gap-2">
        <div class="flex flex-col text-gray-500">
            <button class="" @click="upvote">
                <UpvoteIcon :active="!!isUpvoted" />
            </button>
            <p class="text-center">{{ upvoteCount }}/{{ downvoteCount }}</p>
            <button class="" @click="downvote">
                <DownvoteIcon :active="!!isDownvoted" />
            </button>
        </div>
        <div class="rounded-lg bg-gray-100 p-2">
            <div class="flex gap-2 items-start space-x-2">
                <img
                    :src="'/storage/' + user_media_path"
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
        </div>
    </div>
</template>
<script>
import UpvoteIcon from "../Icons/Upvote.vue";
import DownvoteIcon from "../Icons/Downvote.vue";
import axios from "axios";

export default {
    components: {
        UpvoteIcon,
        DownvoteIcon,
    },
    props: {
        comment: {
            type: Object,
            required: true,
        },
        current_user_id: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            upvoteCount: this.comment.post_comment_reacts.filter(
                (react) => react.type === "upvote"
            ).length,
            downvoteCount: this.comment.post_comment_reacts.filter(
                (react) => react.type === "downvote"
            ).length,

            isUpvoted: this.comment.post_comment_reacts.filter(
                (react) =>
                    react.type === "upvote" &&
                    react.user_id === this.current_user_id
            ).length,
            isDownvoted: this.comment.post_comment_reacts.filter(
                (react) =>
                    react.type === "downvote" &&
                    react.user_id === this.current_user_id
            ).length,
            user_media_path: this.comment.user.user_media[0]
                ? this.comment.user.user_media[0].path
                : "users/default.jpg",
        };
    },
    methods: {
        upvote() {
            if (this.isUpvoted) {
                axios
                    .delete(`/comments/${this.comment.id}/react`)
                    .then(() => {
                        this.upvoteCount--;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else {
                axios
                    .post(`/comments/${this.comment.id}/react`, {
                        type: "upvote",
                    })
                    .then(() => {
                        if (this.isDownvoted) {
                            this.downvoteCount--;
                        }
                        this.isDownvoted = false;
                        this.upvoteCount++;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
            this.isUpvoted = !this.isUpvoted;
        },
        downvote() {
            if (this.isDownvoted) {
                axios
                    .delete(`/comments/${this.comment.id}/react`)
                    .then(() => {
                        this.downvoteCount--;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else {
                axios
                    .post(`/comments/${this.comment.id}/react`, {
                        type: "downvote",
                    })
                    .then(() => {
                        if (this.isUpvoted) {
                            this.upvoteCount--;
                        }
                        this.isUpvoted = false;
                        this.downvoteCount++;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
            this.isDownvoted = !this.isDownvoted;
        },
    },
};
</script>
