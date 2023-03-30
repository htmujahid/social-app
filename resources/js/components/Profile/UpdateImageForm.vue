<script setup>
import { reactive } from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const userMediaPreview = ref(null);
const userMediaError = ref(null);

const userMedia = reactive({
    path: getUserMediaPath(),
});

function getUserMediaPath() {
    return props.user.user_media.length > 0
        ? props.user.user_media[0].path
        : "users/default.jpg";
}

function previewImage() {
    const file = userMediaPreview.value.files[0];
    const reader = new FileReader();
    reader.addEventListener(
        "load",
        () => {
            userMediaError.value.textContent = "";
            userMediaPreview.value.src = reader.result;
        },
        false
    );

    if (file) {
        reader.readAsDataURL(file);
    }
}

function submitForm() {
    const userMediaFile = userMediaPreview.value.files[0];

    if (!userMediaFile) {
        userMediaError.value.textContent = "Please select an image.";
        return;
    }

    const formData = new FormData();
    formData.append("user-media", userMediaFile);

    axios
        .post("/profile/image", formData)
        .then(() => {
            window.location.reload();
        })
        .catch((error) => {
            console.log(error);
        });
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ "Profile Image" }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ "Update your account's profile image." }}
            </p>
        </header>

        <form method="post" @submit.prevent="submitForm" class="mt-6 space-y-6">
            <img
                id="user-media-preview"
                ref="userMediaPreview"
                class="w-32 h-32 rounded-full bg-gray-300 object-cover"
                :src="'/storage/' + user_media_path"
            />
            <div>
                <label
                    for="user-media"
                    class="block font-medium text-sm text-gray-700"
                    >Photo</label
                >
                <input
                    id="user-media"
                    name="user-media"
                    ref="userMedia"
                    type="file"
                    @change="previewImage"
                    accept="image/*"
                    class="mt-1 block w-full p-2 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                />
                <p
                    id="user-media-error"
                    ref="userMediaError"
                    class="text-sm text-red-600"
                ></p>
            </div>

            <div class="flex items-center gap-4">
                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    Save
                </button>
            </div>
        </form>
    </section>
</template>
