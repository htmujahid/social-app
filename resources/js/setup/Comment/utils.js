export function getUpvoteCount(post_comment_reacts) {
    return post_comment_reacts.filter((react) => react.type === "upvote")
        .length;
}

export function getDownvoteCount(post_comment_reacts) {
    return post_comment_reacts.filter((react) => react.type === "downvote")
        .length;
}

export function isUpvoted(post_comment_reacts, currentUserId) {
    return post_comment_reacts.filter(
        (react) => react.type === "upvote" && react.user_id === currentUserId
    ).length;
}

export function isDownvoted(post_comment_reacts, currentUserId) {
    return post_comment_reacts.filter(
        (react) => react.type === "downvote" && react.user_id === currentUserId
    ).length;
}
