<script setup>
import { reactive, ref } from "vue";

const props = defineProps({
    person: {
        type: Object,
        required: true,
    },
    card_type: {
        type: String,
        required: false,
    },
});

const addButton = ref(null);
const cancelButton = ref(null);

const userMedia = reactive({
    path: getUserMediaPath(),
});

function getUserMediaPath() {
    return props.person.user_media.length > 0
        ? props.person.user_media[0].path
        : "users/default.jpg";
}

function addFriend() {
    axios
        .post(`/persons/${props.person.id}/addfriend`)
        .then(() => {
            addButton.value.innerText = "Request Sent";
            addButton.value.disabled = true;
        })
        .catch((error) => {
            console.log(error);
        });
}
function cancelRequest() {
    axios
        .delete(`/persons/${props.person.id}/cancel`)
        .then(() => {
            cancelButton.value.innerText = "Request Cancelled";
            cancelButton.value.disabled = true;
        })
        .catch((error) => {
            console.log(error);
        });
}
</script>

<template>
    <div class="w-full sm:h-24 bg-gray-200 rounded-xl">
        <div
            class="px-4 py-2 flex flex-col sm:flex-row gap-2 sm:gap-4 sm:h-24 items-center justify-between"
        >
            <div class="h-20 w-20 rounded-full bg-gray-300">
                <img
                    class="h-full w-full rounded-full bg-gray-300 object-cover"
                    :src="'/storage/' + userMedia.path"
                    :alt="person.name"
                />
            </div>
            <a :href="'/' + person.id + '/posts'">
                <div class="font-bold text-lg">{{ person.name }}</div>
            </a>
            <div class="flex-1 hidden sm:block"></div>
            <div class="">
                <button
                    class="bg-red-500 rounded-xl px-4 py-2 font-medium text-white"
                    @click="cancelRequest"
                    v-if="card_type == 'cancel'"
                    ref="cancelButton"
                >
                    Cancel Request
                </button>
                <button
                    class="bg-blue-500 rounded-xl px-4 py-2 font-medium text-white"
                    @click="addFriend"
                    v-else
                    ref="addButton"
                >
                    Add Friend
                </button>
            </div>
        </div>
    </div>
</template>
