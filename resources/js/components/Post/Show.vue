<script setup>
import Comment from "../Comment/Show.vue";
import CreateComment from "../Comment/Create.vue";
import HeartIcon from "../Icons/Heart.vue";
import CommentIcon from "../Icons/Comment.vue";
import StatsIcon from "../Icons/Stats.vue";
import DeleteIcon from "../Icons/Delete.vue";
import LeftArrowIcon from "../Icons/Left.vue";
import RightArrowIcon from "../Icons/Right.vue";
import axios from "axios";
import { defineComponent, onMounted, reactive, ref } from "vue";

defineComponent({
    components: {
        Comment,
        CreateComment,
        HeartIcon,
        CommentIcon,
        StatsIcon,
        DeleteIcon,
        LeftArrowIcon,
        RightArrowIcon,
    },
});
const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
    current_user_id: {
        type: Number,
        required: true,
    },
});

const postRef = ref(null);
const prevBtn = ref(null);
const nextBtn = ref(null);
const imageCarousel = ref(null);

const post = reactive({
    user_media_path: getUserMediaPath(),
    isLiked: isLiked(),
    isViewed: isViewed(),
    commentCount: props.post.post_comments.length,
    likeCount: props.post.post_reacts.length,
    statCount: props.post.post_stats.length,
    observer: null,
    current_post_comments: props.post.post_comments,
    ...props.post,
});

const isCommentsActive = ref(false);

function getUserMediaPath() {
    return props.post.user.user_media.length > 0
        ? props.post.user.user_media[0].path
        : "users/default.jpg";
}

function isLiked() {
    return (
        props.post.post_reacts.filter(
            (like) => like.user_id === props.current_user_id
        ).length > 0
    );
}

function isViewed() {
    return (
        props.post.post_stats.filter(
            (stat) => stat.user_id === props.current_user_id
        ).length > 0
    );
}

const options = {
    root: null,
    rootMargin: "0px",
    threshold: 1,
};

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            setTimeout(() => {
                if (entry.isIntersecting && !post.isViewed) {
                    axios
                        .post(`/posts/${props.post.id}/stat`)
                        .then(() => {
                            post.isViewed = true;
                            post.statCount.value++;
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            }, 3000);
        } else {
            clearTimeout();
        }
    });
}, options);

onMounted(() => {
    observer.observe(postRef.value);
});

function nextImage() {
    imageCarousel.value.scrollLeft += imageCarousel.value.offsetWidth;
    prevBtn.value.classList.remove("hidden");

    if (
        imageCarousel.value.scrollLeft + imageCarousel.value.offsetWidth >=
        imageCarousel.value.scrollWidth
    ) {
        nextBtn.value.classList.add("hidden");
    }
}

function prevImage() {
    imageCarousel.value.scrollLeft -= imageCarousel.value.offsetWidth;

    nextBtn.value.classList.remove("hidden");

    if (imageCarousel.value.scrollLeft <= 0) {
        prevBtn.value.classList.add("hidden");
    }
}

function toggleComment() {
    isCommentsActive.value = !isCommentsActive.value;
}

function likePost() {
    post.isLiked = !post.isLiked;

    if (post.isLiked) {
        axios
            .post(`/posts/${post.id}/react`, {
                type: "like",
            })
            .then(() => {
                post.likeCount++;
            })
            .catch((err) => {
                console.log(err);
            });
    } else {
        axios
            .delete(`/posts/${post.id}/react`)
            .then(() => {
                post.likeCount--;
            })
            .catch((err) => {
                console.log(err);
            });
    }
}

function deletePost() {
    axios
        .delete(`/posts/${post.id}`)
        .then(() => {
            window.location.reload();
        })
        .catch((err) => {
            console.log(err);
        });
}

function commentCreated() {
    window.location.reload();
}
</script>

<template>
    <div
        class="duration-250 scale-100 rounded-lg border bg-white from-gray-700/50 via-transparent px-6 pt-6 pb-3 shadow-2xl shadow-gray-500/20 transition-all focus:outline focus:outline-2 focus:outline-red-500 motion-safe:hover:scale-[1.01]"
        ref="postRef"
    >
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-red-50"
                >
                    <img
                        :src="'/storage/' + post.user_media_path"
                        class="h-12 w-12 rounded-full bg-gray-300 object-cover"
                    />
                </div>
                <div>
                    <h2 class="font-semibold text-gray-900">
                        {{ post.user.name }}
                    </h2>
                    <p class="text-xs font-light">
                        {{ new Date(post.created_at).toLocaleString() }}
                    </p>
                </div>
            </div>
            <button
                @click="deletePost"
                v-show="post.user_id === current_user_id"
                class="focus:outline-none"
            >
                <DeleteIcon />
            </button>
        </div>
        <div>
            <p class="mt-4 text-sm leading-relaxed text-gray-500">
                {{ post.content }}
            </p>
            <div
                class="flex items-center overflow-x-auto max-w-[550px] scroll-smooth hide-scrollbar"
                ref="imageCarousel"
            >
                <button
                    ref="prevBtn"
                    class="absolute left-0 z-10 p-2 hidden rounded-full bg-gray-100/50"
                    @click="prevImage"
                >
                    <LeftArrowIcon />
                </button>
                <button
                    ref="nextBtn"
                    :class="{
                        hidden: post.post_media.length <= 1,
                    }"
                    class="absolute right-0 z-10 p-2 rounded-full bg-gray-100/50"
                    @click="nextImage"
                >
                    <RightArrowIcon />
                </button>
                <template v-for="media in post.post_media" :key="media">
                    <div class="shrink-0 w-full">
                        <img
                            :src="'/storage/' + media.path"
                            class="max-h-96 mx-auto"
                        />
                    </div>
                </template>
            </div>
        </div>
        <div
            class="mt-3 flex justify-center items-center border-t border-b py-1 text-sm text-gray-500"
        >
            <div class="w-full flex justify-center items-center gap-2">
                <button class="" @click="likePost">
                    <HeartIcon :active="!!post.isLiked" />
                </button>
                <span>
                    {{ post.likeCount > 0 ? post.likeCount : "" }}
                </span>
            </div>
            <div class="w-full flex justify-center items-center gap-2">
                <button class="" @click="toggleComment">
                    <CommentIcon />
                </button>
                <span class="">
                    {{ post.commentCount > 0 ? post.commentCount : "" }}
                </span>
            </div>
            <div class="w-full flex justify-center items-center gap-2">
                <p class="">
                    <StatsIcon />
                </p>

                <span> {{ post.statCount > 0 ? post.statCount : "" }} </span>
            </div>
        </div>
        <div class="mt-3 flex flex-col gap-2" v-show="isCommentsActive">
            <template
                v-for="comment in post.current_post_comments"
                :key="comment.id"
            >
                <Comment
                    :comment="comment"
                    :current_user_id="current_user_id"
                    :post_id="this.post.id"
                />
            </template>
            <CreateComment
                :post_id="this.post.id"
                :current_user_id="current_user_id"
                @comment-created="commentCreated"
            />
        </div>
    </div>
</template>
