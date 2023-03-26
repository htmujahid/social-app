<template>
    <form @submit.prevent="createComment">
        <div class="flex gap-2 rounded border flex-col sm:flex-row">
            <textarea
                type="text"
                class="w-full text-sm rounded p-2.5 border-0 focus:outline-none focus:ring-0"
                placeholder="write your comment here"
                rows="1"
                v-model="content"
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

<script>
import axios from "axios";
export default {
    name: "Create",
    props: {
        post_id: {
            type: Number,
            required: true,
        },
        current_user_id: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            content: "",
            validationError: false,
        };
    },
    methods: {
        createComment() {
            if (this.content === "") {
                this.validationError = true;
                setInterval(() => {
                    this.validationError = false;
                }, 3000);
                return;
            }
            axios
                .post("/comments", {
                    content: this.content,
                    post_id: this.post_id,
                })
                .then((response) => {
                    this.$emit("comment-created");
                    this.content = "";
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
