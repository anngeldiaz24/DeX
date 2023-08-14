@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}

@endsection

@push('styles')

@endpush

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2 ml-2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Image Post: {{ $post->titulo }}">

            
            <div class="p-3 flex items-center gap-4 mr-2">
                {{-- a user needs to be authenticated to like a post --}}
            @auth
                <livewire:like-post :post="$post" />

                {{--@if ($post->checkLike(auth()->user()))
                 User has already like the post 
                    <form method="POST" action="{{ route('posts.likes.destroy', $post) }}">
                        @method('DELETE')
                        @csrf
                        <div class="my-4">
                        
                        </div>                    
                    </form> 
                @else
                    {{-- No like --}}
                    {{-- The user only will be able to like a post if he/she
                        has not already liked the post 
                    <form method="POST" action="{{ route('posts.likes.store', $post) }}">
                        @csrf
                        <div class="my-4">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>  
                            </button>
                        </div>                    
                    </form> 
                @endif --}}

            @endauth
                    {{-- {{-- Cantidad de likes 
                <p class="font-bold">{{ $post->likes->count() }} 
                    <span class="font-normal"> likes</span>
                </p> --}}
            </div>


            <div class="ml-2" >
                <!-- post takes user from the relation-->
                <p class="font-bold dark:text-white dark:font-bold"> {{ $post->user->username }}</p>
                    <p class="dark:text-white">{{ $post->descripcion }}</p>
                <p class="text-sm text-gray-500 dark:text-white">
                    <!-- We achieve this with carbon library -->
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>

            @auth
                <!--If the creator of this post is the same person who is authenticated
                he/she, will be able to delete the post  -->
                @if ($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        <!-- Spoofing Method Agregar metodos como (PUT, DELETE)-->
                        @method('DELETE')
                        @csrf
                            <button type="submit" class=" bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-5 cursor-pointer dark:text-white dark:bg-red-500 dark:hover:bg-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>    
                                <span>Delete</span>
                            </button>
                    </form>
                @endif
            @endauth
        </div>

        <div class="md:w-1/2 p-5 ml-2 mb-5">
            <div class="shadow bg-white p-5 mb-5 dark:bg-zinc-900">
                
                @auth
                {{-- User only can post a comment if he/she is already authenticated --}}
                    <p class="text-xl font-bold text-center mb-4 dark:text-white">Comments</p>

                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', [ 'post' => $post, 'user' => $user ]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold dark:text-white">
                                Write a comment
                            </label>
                            <textarea 
                                class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror" 
                                id="comentario" 
                                name="comentario" 
                                placeholder="Add a comment..."
                            ></textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="Submit" value="Comment" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"/>
                    </form>
                @endauth
                
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10 dark:bg-zinc-900">
                    @if ($post->comentarios->count())
                        @foreach ( $post->comentarios as $comentario )
                            <div class="p-5 border-gray-300 border-b">
                                {{-- If you click in the user, the page will redirect you to her/his profile
                                    It is neccesary to send the user to redirect it correctly ($comentario->user) --}}
                                <a class="font-bold dark:text-white dark:font-bold" href="{{ route('posts.index', $comentario->user ) }}">
                                    {{ $comentario->user->username }}
                                </a>
                                <p class="dark:text-white">{{ $comentario->comentario }}</p>
                                <p class="text-sm text-gray-500 dark:text-white">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center dark:text-white">No comments yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection