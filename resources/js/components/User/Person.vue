<template>
    <div class="w-full sm:h-24 bg-gray-200 rounded-xl">
        <div
            class="px-4 py-2 flex flex-col sm:flex-row gap-2 sm:gap-4 sm:h-24 items-center justify-between"
        >
            <div class="h-20 w-20 rounded-full bg-gray-300"></div>
            <div class="font-bold text-lg">{{ person.name }}</div>
            <div class="flex-1 hidden sm:block"></div>
            <div class="">
                <button
                    class="bg-red-500 rounded-xl px-4 py-2 font-medium text-white"
                    @click="cancelRequest"
                    v-if="person_type == 'cancel'"
                >
                    Cancel Request
                </button>
                <button
                    class="bg-blue-500 rounded-xl px-4 py-2 font-medium text-white"
                    @click="addFriend"
                    v-else
                    :test="person_type"
                >
                    Add Friend
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Person",
    props: {
        person: {
            type: Object,
            required: true,
        },
        person_type: {
            type: String,
            required: false,
        },
    },
    data() {
        return {};
    },
    methods: {
        addFriend() {
            axios
                .post(`/persons/${this.person.id}/addfriend`)
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },
        cancelRequest() {
            axios
                .delete(`/persons/${this.person.id}/cancel`)
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
