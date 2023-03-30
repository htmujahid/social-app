<script setup>
import axios from "axios";
import { reactive } from "vue";

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

const comment = reactive({
    content: "",
    validationError: false,
});

function createComment() {
    if (comment.content === "") {
        comment.validationError = true;
        setInterval(() => {
            comment.validationError = false;
        }, 3000);
        return;
    }
    axios
        .post("/comments", {
            content: comment.content,
            post_id: props.post_id,
        })
        .then((response) => {
            window.location.reload();
        })
        .catch((error) => {
            console.log(error);
        });
}
</script>

<template>
    <form @submit.prevent="createComment">
        <div class="flex gap-2 rounded border flex-col sm:flex-row">
            <textarea
                type="text"
                class="w-full text-sm rounded p-2.5 border-0 focus:outline-none focus:ring-0"
                placeholder="write your comment here"
                rows="1"
                v-model="comment.content"
            ></textarea>
            <button type="submit" class="test-sm px-3">Submit</button>
        </div>
        <p id="error">
            <span v-show="comment.validationError" class="text-red-500">
                Please enter some content
            </span>
        </p>
    </form>
</template>
