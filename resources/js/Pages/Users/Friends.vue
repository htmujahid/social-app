<script setup>
import Friend from "@/Components/User/Friend.vue";
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head } from "@inertiajs/vue3";

import { ref } from "vue";

defineProps({
    friends: {
        type: Array,
        required: true,
    },
    unresponded_requests: {
        type: Array,
        required: true,
    },
});

defineOptions({
    layout: UserLayout,
});

const activeTab = ref("friends");

function toggleTab(tab) {
    activeTab.value = tab;
}
</script>

<template>
    <Head title="Friends" />

    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-y-4 p-6 lg:p-8">
        <div
            class="flex flex-col sm:flex-row items-center w-full text-center rounded-lg overflow-hidden border"
        >
            <div class="w-full">
                <button
                    :class="
                        activeTab === 'friends'
                            ? 'bg-blue-500 text-white'
                            : 'bg-gray-200 text-gray-500'
                    "
                    class="p-2 w-full"
                    @click="toggleTab('friends')"
                >
                    All Friends
                </button>
            </div>
            <div class="w-full">
                <button
                    :class="
                        activeTab === 'friends'
                            ? 'bg-gray-200 text-gray-500'
                            : 'bg-blue-500 text-white'
                    "
                    class="p-2 w-full"
                    @click="toggleTab('unresponded')"
                >
                    Unresponded Requests
                </button>
            </div>
        </div>

        <div v-if="activeTab === 'friends'" class="flex flex-col gap-4">
            <template v-for="friend in friends" :key="friend.id">
                <Friend :friend="friend" card_type="" />
            </template>
        </div>
        <div v-if="activeTab === 'unresponded'" class="flex flex-col gap-4">
            <template
                v-for="unresponded_request in unresponded_requests"
                :key="unresponded_request.id"
            >
                <Friend :friend="unresponded_request" card_type="confirm" />
            </template>
        </div>
    </div>
</template>
