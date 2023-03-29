import { createApp } from "vue/dist/vue.esm-bundler";

const app = createApp({});

import PostShow from "./components/Post/Show.vue";
import PostCreate from "./components/Post/Create.vue";
import Person from "./components/User/Person.vue";
import Friend from "./components/User/Friend.vue";
import UpdateProfileImageForm from "./components/Profile/UpdateImageForm.vue";

app.component("v-post-show", PostShow);
app.component("v-post-create", PostCreate);
app.component("v-person", Person);
app.component("v-friend", Friend);
app.component("v-update-profile-image-form", UpdateProfileImageForm);

app.mount("#app");
