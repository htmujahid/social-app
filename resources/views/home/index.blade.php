<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="relative bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
        {{-- @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif --}}

        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-y-4 p-6 lg:p-8">
            <div>
                <v-post-create />
            </div>
            @foreach ($posts as $post)                
                <div>
                    <v-post-show 
                        :post_id="{{ $post->id }}"
                        :post_user_id="{{ $post->user->id }}"
                        :user_name="{{ json_encode($post->user->name) }}"
                        :post_created_at="{{ json_encode($post->created_at) }}"
                        :post_content="{{ json_encode($post->content) }}"
                        :post_media="{{ json_encode($post->postMedia) }}"
                        :post_likes="{{ json_encode($post->postReacts) }}"
                        :post_comments="{{ json_encode($post->postComments) }}"
                        :post_stats="{{json_encode($post->postStats)}}"
                        :current_user_id="{{ json_encode(Auth::id()) }}"
                    />
                </div>
            @endforeach
        </div>
    </div>
</x-user-layout>