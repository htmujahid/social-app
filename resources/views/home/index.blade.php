<x-user-layout>
    <div class="relative bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">

        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-y-4 p-6 lg:p-8">
            <div>
                <v-post-create />
            </div>
            @forelse ($posts as $post)                
                <div>
                    <v-post-show 
                        :post_id="{{ $post->id }}"
                        :post_user_id="{{ $post->user->id }}"
                        :user_name="{{ json_encode($post->user->name) }}"
                        :user_media="{{ $post->user->userMedia}}"
                        :post_created_at="{{ json_encode($post->created_at) }}"
                        :post_content="{{ json_encode($post->content) }}"
                        :post_media="{{ json_encode($post->postMedia) }}"
                        :post_likes="{{ json_encode($post->postReacts) }}"
                        :post_comments="{{ json_encode($post->postComments) }}"
                        :post_stats="{{json_encode($post->postStats)}}"
                        :current_user_id="{{ json_encode(Auth::id()) }}"
                    />
                </div>
            @empty
                <div class="text-center">
                    <p class="text-gray-500">No posts yet</p>
                </div>
            @endforelse
        </div>
    </div>
</x-user-layout>
