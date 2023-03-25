<template>
    <div
        class="duration-250 scale-100 rounded-lg border bg-white from-gray-700/50 via-transparent px-6 pt-6 pb-3 shadow-2xl shadow-gray-500/20 transition-all focus:outline focus:outline-2 focus:outline-red-500 motion-safe:hover:scale-[1.01]"
    >
        <form @submit="storePost">
            <textarea
                name="post-content"
                id="post-content"
                rows="6"
                class="w-full text-sm focus:outline-none focus:ring-0"
                placeholder="What's on your mind?"
                v-model="content"
            ></textarea>
            <div class="flex flex-wrap gap-2" id="post-media-preview"></div>
            <input
                type="file"
                name="post-media"
                id="post-media"
                accept="image/*"
                multiple
                @change="previewMedia"
            />
            <p id="error" v-show="validationError" class="text-red-500">
                Please enter some content or upload a media file
            </p>

            <div
                class="mt-3 flex items-center border-t border-b py-1 text-center"
            >
                <button
                    type="submit"
                    class="w-full rounded py-1 hover:bg-gray-50"
                >
                    Submit
                </button>
                <button
                    class="w-full rounded py-1 hover:bg-gray-50"
                    @click="discardPost"
                    type="button"
                >
                    Discard
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Create",
    data() {
        return {
            content: "",
            media: [],
            baseUrl: window.location.origin,
            validationError: false,
        };
    },
    methods: {
        previewMedia() {
            const postMedia = document.getElementById("post-media");
            const preview = document.getElementById("post-media-preview");

            for (let i = 0; i < postMedia.files.length; i++) {
                const file = postMedia.files[i];
                const reader = new FileReader();

                this.media.push(file);
                console.log(this.media);
                reader.addEventListener(
                    "load",
                    function () {
                        const image = document.createElement("img");
                        image.src = reader.result;
                        image.classList.add("w-20", "h-20", "rounded");
                        preview.appendChild(image);
                    },
                    false
                );

                if (file) {
                    reader.readAsDataURL(file);
                }
            }
        },
        discardPost() {
            const preview = document.getElementById("post-media-preview");
            this.content = "";
            this.media = [];
            preview.innerHTML = "";
        },
        validatePost() {
            if (!this.content && !this.media.length) {
                return false;
            }
            return true;
        },
        storePost() {
            const postMedia = document.getElementById("post-media");
            const preview = document.getElementById("post-media-preview");

            if (!this.validatePost()) {
                this.validationError = true;
                setInterval(() => {
                    this.validationError = false;
                }, 3000);
                return;
            }

            const formData = new FormData();
            formData.append("content", this.content);

            for (let i = 0; i < this.media.length; i++) {
                formData.append(`media[${i}]`, this.media[i]);
            }
            axios
                .post("/posts", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(() => {
                    window.location.reload();
                })
                .catch((error) => {
                    alert(error.response.data.message);
                });
        },
    },
};
</script>
