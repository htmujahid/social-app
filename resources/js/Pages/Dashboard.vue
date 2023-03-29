<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps(["userOfWeek", "users_count", "posts_count", "comments_count"]);
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <div class="py-12">
            <div
                class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-4"
            >
                <div
                    class="relative overflow-x-auto shadow-md bg-white sm:rounded-lg p-4"
                >
                    User of Week: {{ userOfWeek.name }}
                </div>
                <div
                    class="relative overflow-x-auto shadow-md bg-white sm:rounded-lg p-4"
                >
                    Total Users: {{ users_count }}
                </div>
                <div
                    class="relative overflow-x-auto shadow-md bg-white sm:rounded-lg p-4"
                >
                    Total Posts: {{ posts_count }}
                </div>
                <div
                    class="relative overflow-x-auto shadow-md bg-white sm:rounded-lg p-4"
                >
                    Total Comments: {{ comments_count }}
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
