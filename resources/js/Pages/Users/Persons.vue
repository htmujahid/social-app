<script setup>
import Person from "@/Components/User/Person.vue";
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head } from "@inertiajs/vue3";

import { ref } from "vue";

defineProps({
    persons: {
        type: Array,
        required: true,
    },
    pending_persons: {
        type: Array,
        required: true,
    },
});

defineOptions({
    layout: UserLayout,
});

const activeTab = ref("persons");

function toggleTab(tab) {
    activeTab.value = tab;
}
</script>
<template>
    <Head title="Persons" />

    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-y-4 p-6 lg:p-8">
        <div
            class="flex flex-col sm:flex-row items-center w-full text-center rounded-lg overflow-hidden border"
        >
            <div class="w-full">
                <button
                    :class="
                        activeTab === 'persons'
                            ? 'bg-blue-500 text-white'
                            : 'bg-gray-200 text-gray-500'
                    "
                    class="p-2 w-full"
                    @click="toggleTab('persons')"
                >
                    All Persons
                </button>
            </div>
            <div class="w-full">
                <button
                    :class="
                        activeTab === 'persons'
                            ? 'bg-gray-200 text-gray-500'
                            : 'bg-blue-500 text-white'
                    "
                    class="p-2 w-full"
                    @click="toggleTab('pending')"
                >
                    Pending Requests
                </button>
            </div>
        </div>

        <div v-if="activeTab === 'persons'" class="flex flex-col gap-6">
            <template v-for="person in persons" :key="person.id">
                <Person :person="person" />
            </template>
        </div>
        <div v-if="activeTab === 'pending'" class="flex flex-col gap-6">
            <template
                v-for="pending_person in pending_persons"
                :key="pending_person.id"
            >
                <Person :person="pending_person" card_type="cancel" />
            </template>
        </div>
    </div>
</template>
