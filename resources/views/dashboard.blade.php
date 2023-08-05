@extends('layouts.app')

@section('titulo')
    Account: {{ $user->username }}
@endsection


@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src= "{{ asset('img/usuario.svg')  }}" alt="User image" />
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">      
                <p class="text--700 text-2xl">{{ $user->username }}</p>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    0
                    <span class="font-normal">Followers</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Following</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Posts</span>
                </p>
            </div>
        </div>
    </div>

    <section>
        <h2 class="text-4xl text-center font-black my-10">POSTS</h2>

        @if ($posts->count())
        
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 m-10">
                @foreach ($posts as $post)
                    <div>
                        <a>
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Post Image {{ $post->titulo }}">
                        </a>
                    </div>   
                @endforeach
            </div>

            {{-- Paginar posts --}}
             {{-- We add the route (tailwind.config.js) in which we can find the dependecy to add style in the pagination --}}
            <div class="m-10">
                {{ $posts->links('pagination::tailwind') }}
            </div>        
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No posts yet</p>
        @endif

    </section>

@endsection
