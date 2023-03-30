<script setup>
import { useForm } from "@inertiajs/vue3";
import { reactive, ref } from "vue";

const props = defineProps({
    post_id: {
        type: Number,
        required: true,
    },
    current_user_id: {
        type: Number,
        required: true,
    },
});

const validationError = ref(false);

const form = useForm({
    content: "",
    post_id: props.post_id,
});

const submit = () => {
    if (form.content.trim() === "") {
        validationError.value = true;
        setTimeout(() => {
            validationError.value = false;
        }, 3000);
        return;
    }
    form.post(route("comments.store"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit">
        <div class="flex gap-2 rounded border flex-col sm:flex-row">
            <textarea
                type="text"
                class="w-full text-sm rounded p-2.5 border-0 focus:outline-none focus:ring-0"
                placeholder="write your comment here"
                rows="1"
                required
                v-model="form.content"
            ></textarea>
            <button type="submit" class="test-sm px-3">Submit</button>
        </div>
        <p id="error">
            <span v-show="validationError" class="text-red-500">
                Please enter some content
            </span>
        </p>
    </form>
</template>
