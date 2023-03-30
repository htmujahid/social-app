export function getUserMediaPath(user) {
    return user.user_media[0] ? user.user_media[0].path : "users/default.jpg";
}
