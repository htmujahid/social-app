<template>
    <div class="w-full sm:h-24 bg-gray-200 rounded-xl">
        <div
            class="px-4 py-2 flex flex-col sm:flex-row gap-2 sm:gap-4 sm:h-24 items-center justify-between"
        >
            <div class="h-20 w-20 rounded-full bg-gray-300"></div>
            <div class="font-bold text-lg">{{ friend.name }}</div>
            <div class="flex-1 hidden sm:block"></div>
            <div class="">
                <button
                    class="bg-blue-500 rounded-xl px-4 py-2 font-medium text-white"
                    @click="confirmFriend"
                    v-if="friend_type == 'confirm'"
                >
                    Confirm
                </button>
                <button
                    class="bg-red-500 rounded-xl px-4 py-2 font-medium text-white"
                    @click="removeFriend"
                    v-else
                >
                    Remove
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Friend",
    props: {
        friend: {
            type: Object,
            required: true,
        },
        friend_type: {
            type: String,
            required: false,
        },
    },
    methods: {
        confirmFriend() {
            axios
                .post(`/friends/${this.friend.id}/acceptfriend`)
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },
        removeFriend() {
            axios
                .delete(`/friends/${this.friend.id}/unfriend`)
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
