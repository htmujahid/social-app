<template>
    <div
        class="duration-250 scale-100 rounded-lg border bg-white from-gray-700/50 via-transparent px-6 pt-6 pb-3 shadow-2xl shadow-gray-500/20 transition-all focus:outline focus:outline-2 focus:outline-red-500 motion-safe:hover:scale-[1.01]"
        ref="post"
    >
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-red-50"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        class="h-7 w-7 stroke-red-500"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"
                        />
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-gray-900">
                        {{ user_name }}
                    </h2>
                    <p class="text-xs font-light">
                        {{ new Date(post_created_at).toLocaleString() }}
                    </p>
                </div>
            </div>
            <button
                @click="deletePost"
                v-show="post_user_id === current_user_id"
                class="focus:outline-none"
            >
                <DeleteIcon />
            </button>
        </div>
        <div>
            <p class="mt-4 text-sm leading-relaxed text-gray-500">
                {{ post_content }}
            </p>
            <div
                class="flex items-center overflow-x-auto max-w-[550px] scroll-smooth hide-scrollbar"
                ref="image-carousel"
            >
                <button
                    ref="prev-btn"
                    class="absolute left-0 z-10 p-2 hidden rounded-full bg-gray-100/50"
                    @click="prevImage"
                >
                    <LeftArrowIcon />
                </button>
                <button
                    ref="next-btn"
                    :class="{
                        hidden: post_media.length <= 1,
                    }"
                    class="absolute right-0 z-10 p-2 rounded-full bg-gray-100/50"
                    @click="nextImage"
                >
                    <RightArrowIcon />
                </button>
                <template v-for="media in post_media" :key="media">
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
                    <HeartIcon :active="!!isLiked" />
                </button>
                <span>
                    {{ likeCount > 0 ? likeCount : "" }}
                </span>
            </div>
            <div class="w-full flex justify-center items-center gap-2">
                <button class="" @click="toggleComment">
                    <CommentIcon />
                </button>
                <span class="">
                    {{ commentCount > 0 ? commentCount : "" }}
                </span>
            </div>
            <div class="w-full flex justify-center items-center gap-2">
                <p class="">
                    <StatsIcon />
                </p>

                <span> {{ statCount > 0 ? statCount : "" }} </span>
            </div>
        </div>
        <div class="mt-3 flex flex-col gap-2" v-show="isCommentsActive">
            <template v-for="comment in post_comments" :key="comment.id">
                <Comment
                    :comment="comment"
                    :current_user_id="current_user_id"
                />
            </template>
            <CreateComment :post_id="post_id" />
        </div>
    </div>
</template>

<script>
import Comment from "../Comment/Show.vue";
import CreateComment from "../Comment/Create.vue";
import HeartIcon from "../Icons/Heart.vue";
import CommentIcon from "../Icons/Comment.vue";
import StatsIcon from "../Icons/Stats.vue";
import DeleteIcon from "../Icons/Delete.vue";
import LeftArrowIcon from "../Icons/Left.vue";
import RightArrowIcon from "../Icons/Right.vue";

export default {
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
    props: {
        post_id: {
            type: Number,
            required: true,
        },
        post_user_id: {
            type: Number,
            required: true,
        },
        post_content: {
            type: String,
            required: false,
        },
        user_name: {
            type: String,
            required: true,
        },
        post_created_at: {
            type: String,
            required: true,
        },
        post_media: {
            type: Array,
            required: false,
        },
        post_comments: {
            type: Array,
            required: false,
        },
        post_likes: {
            type: Array,
            required: false,
        },
        post_stats: {
            type: Array,
            required: false,
        },
        current_user_id: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            isCommentsActive: false,
            isLiked:
                this.post_likes.filter(
                    (like) => like.user_id === this.current_user_id
                ).length > 0,
            isViewed:
                this.post_stats.filter(
                    (stat) => stat.user_id === this.current_user_id
                ).length > 0,
            commentCount: this.post_comments.length,
            likeCount: this.post_likes.length,
            statCount: this.post_stats.length,
            observer: null,
        };
    },
    mounted() {
        const options = {
            root: null,
            rootMargin: "0px",
            threshold: 1,
        };

        this.observer = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        if (entry.isIntersecting && !this.isViewed) {
                            axios
                                .post(`/posts/${this.post_id}/stat`)
                                .then(() => {
                                    this.isViewed = true;
                                    this.statCount++;
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

        this.observer.observe(this.$refs.post);
    },
    methods: {
        nextImage() {
            const imageCarousel = this.$refs["image-carousel"];
            imageCarousel.scrollLeft += imageCarousel.offsetWidth;
            const prevBtn = this.$refs["prev-btn"];
            prevBtn.classList.remove("hidden");

            if (
                imageCarousel.scrollLeft + imageCarousel.offsetWidth >=
                imageCarousel.scrollWidth
            ) {
                const nextBtn = this.$refs["next-btn"];
                nextBtn.classList.add("hidden");
            }
        },
        prevImage() {
            const imageCarousel = this.$refs["image-carousel"];
            imageCarousel.scrollLeft -= imageCarousel.offsetWidth;

            const nextBtn = this.$refs["next-btn"];
            nextBtn.classList.remove("hidden");

            if (imageCarousel.scrollLeft <= 0) {
                const prevBtn = this.$refs["prev-btn"];
                prevBtn.classList.add("hidden");
            }
        },

        toggleComment() {
            this.isCommentsActive = !this.isCommentsActive;
        },

        likePost() {
            this.isLiked = !this.isLiked;

            if (this.isLiked) {
                axios
                    .post(`/posts/${this.post_id}/react`, {
                        type: "like",
                    })
                    .then(() => {
                        this.likeCount++;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            } else {
                axios
                    .delete(`/posts/${this.post_id}/react`)
                    .then(() => {
                        this.likeCount--;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },

        deletePost() {
            axios
                .delete(`/posts/${this.post_id}`)
                .then(() => {})
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
