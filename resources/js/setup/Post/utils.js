export function validatePost(form) {
    if (!form.content && !form.media.length) {
        return false;
    }
    return true;
}

export function getPostCommentsCount(post) {
    return post.post_comments.length;
}

export function getPostLikesCount(post) {
    return post.post_reacts.length;
}

export function getPostStatsCount(post) {
    return post.post_stats.length;
}

export function isLiked(post, currentUserId) {
    return (
        post.post_reacts.filter((like) => like.user_id === currentUserId)
            .length > 0
    );
}

export function isViewed(post, currentUserId) {
    return (
        post.post_stats.filter((stat) => stat.user_id === currentUserId)
            .length > 0
    );
}
