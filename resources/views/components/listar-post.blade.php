<div>
     {{-- Here you will be able to see the post of your followings --}}
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 m-10">
        @foreach ($posts as $post)
            <div>
                {{-- We send the post object --}}
                <a href="{{ route('posts.show', [ 'post' => $post, 'user' => $post->user ]) }}">
                    <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Post Image {{ $post->titulo }}">
                </a>
            </div>   
        @endforeach
    </div>
    <div class="m-10">
        {{ $posts->links('pagination::tailwind') }}
    </div>     
    @else
        <p class="text-center dark:text-white">No Posts Available</p>
    @endif
</div>