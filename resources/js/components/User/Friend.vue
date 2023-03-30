<script setup>
import { reactive, ref } from "vue";
import { getUserMediaPath } from "@/Setup/User/utils";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    friend: {
        type: Object,
        required: true,
    },
    card_type: {
        type: String,
        required: false,
    },
});

const confirmButton = ref(null);
const removeButton = ref(null);

const userMedia = reactive({
    path: getUserMediaPath(props.friend),
});

const confirmFriendForm = useForm({});

function confirmFriend() {
    confirmFriendForm.post(route("friends.acceptfriend", props.friend.id));
}

const removeFriendForm = useForm({});

function removeFriend() {
    removeFriendForm.post(route("friends.unfriend", props.friend.id));
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
                    :alt="friend.name"
                />
            </div>
            <a :href="'/' + friend.id + '/posts'">
                <div class="font-bold text-lg">{{ friend.name }}</div>
            </a>
            <div class="flex-1 hidden sm:block"></div>
            <div class="">
                <button
                    class="bg-blue-500 rounded-xl px-4 py-2 font-medium text-white"
                    @click="confirmFriend"
                    v-if="card_type == 'confirm'"
                    ref="confirmButton"
                >
                    Confirm
                </button>
                <button
                    class="bg-red-500 rounded-xl px-4 py-2 font-medium text-white"
                    @click="removeFriend"
                    v-else
                    ref="removeButton"
                >
                    Remove
                </button>
            </div>
        </div>
    </div>
</template>
