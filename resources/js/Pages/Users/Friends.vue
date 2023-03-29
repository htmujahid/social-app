<script setup>
import Friend from "@/components/User/Friend.vue";
import UserLayout from "@/Layouts/UserLayout.vue";

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

const activeTab = ref("friends");

function toggleTab(tab) {
    activeTab.value = tab;
}
</script>

<template>
    <UserLayout>
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

            <div v-if="activeTab === 'friends'">
                <template v-for="friend in friends" :key="friend.id">
                    <Friend :friend="friend" card_type="" />
                </template>
            </div>
            <div v-if="activeTab === 'unresponded'">
                <template
                    v-for="unresponded_request in unresponded_requests"
                    :key="unresponded_request.id"
                >
                    <Friend
                        :friend="unresponded_requests"
                        card_type="confirm"
                    />
                </template>
            </div>
        </div>
    </UserLayout>
</template>
