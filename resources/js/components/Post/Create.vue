<script setup>
import { useForm } from "@inertiajs/vue3";
import { reactive, ref } from "vue";
import { validatePost } from "@/Setup/Post/utils";

const post = reactive({
    baseUrl: window.location.origin,
    validationError: false,
});

const form = useForm({
    content: "",
    media: [],
});

const postMedia = ref(null);
const postMediaPreview = ref(null);

function discardPost() {
    form.reset();
    postMedia.value.value = "";
    postMediaPreview.value.innerHTML = "";
}

function previewMedia() {
    for (let i = 0; i < postMedia.value.files.length; i++) {
        const file = postMedia.value.files[i];
        const reader = new FileReader();

        form.media.push(file);
        reader.addEventListener(
            "load",
            function () {
                const image = document.createElement("img");
                image.src = reader.result;
                image.classList.add("w-20", "h-20", "rounded");
                postMediaPreview.value.appendChild(image);
            },
            false
        );

        if (file) {
            reader.readAsDataURL(file);
        }
    }
}

function storePost() {
    if (!validatePost(form)) {
        post.validationError = true;
        setInterval(() => {
            post.validationError = false;
        }, 3000);
        return;
    }

    const formData = new FormData();
    formData.append("content", form.content);

    for (let i = 0; i < form.media.length; i++) {
        formData.append(`media[${i}]`, form.media[i]);
    }

    form.post(route("posts.store"), {
        onFinish: () => {
            form.content = "";
            form.media = [];
            postMedia.value.value = "";
            postMediaPreview.value.innerHTML = "";
        },
    });
}
</script>

<template>
    <div
        class="duration-250 scale-100 rounded-lg border bg-white from-gray-700/50 via-transparent px-6 pt-6 pb-3 shadow-2xl shadow-gray-500/20 transition-all focus:outline focus:outline-2 focus:outline-red-500 motion-safe:hover:scale-[1.01]"
    >
        <form @submit.prevent="storePost">
            <textarea
                name="post-content"
                id="post-content"
                rows="6"
                class="w-full text-sm focus:outline-none focus:ring-0"
                placeholder="What's on your mind?"
                v-model="form.content"
            ></textarea>
            <div class="flex flex-wrap gap-2" ref="postMediaPreview"></div>
            <input
                type="file"
                name="post-media"
                ref="postMedia"
                accept="image/*"
                multiple
                @change="previewMedia"
            />
            <p id="error" v-show="post.validationError" class="text-red-500">
                Please enter some content or upload a media file
            </p>

            <div
                class="mt-3 flex items-center border-t border-b py-1 text-center"
            >
                <button
                    type="submit"
                    class="w-full rounded py-1 hover:bg-gray-50"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing || !form.content"
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
