@extends('layouts.app')

@section('titulo')
    Account: {{ $user->username }}
@endsection


@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                {{-- If an image exists, get the user perfil picture, if not, put usuario.svg --}}
                <img src= "{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}" class="rounded-full" alt="User image" />
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">    
                <div class="flex items-center gap-2">  
                    <p class="text-gray-700 text-2xl dark:text-white">{{ $user->username }}</p>
                    @auth
                    {{-- If the user is authenticated, he/she can edit the profile --}}
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index') }}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                </svg>    
                            </a>
                        @endif
                    @endauth
                </div>  

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5 dark:text-white">
                    {{ $user->followers->count() }}
                    <span class="font-normal dark:text-white">@choice('Follower|Followers', $user->followers->count() )</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold dark:text-white">
                    {{ $user->followings->count() }}
                    <span class="font-normal dark:text-white">Following </span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold dark:text-white">
                    {{ $user->posts->count() }}
                    <span class="font-normal dark:text-white">Posts</span>
                </p>

                @auth
                    {{-- If the current id ("muro") is the same as the authenticated user
                    does not show the follow/unfollow button --}}
                    @if ($user->id !== auth()->user()->id)
                    {{-- If the visitor is not follower, show the follow button --}}
                        @if (!$user->siguiendo(auth()->user()))
                            
                            {{-- $user is the user we want to follow --}}
                            <form action= "{{ route('users.follow', $user )}}" method="POST">
                                @csrf
                                <input 
                                    type="submit" 
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Follow" />
                            </form>
                        @else
                            <form action= "{{ route('users.unfollow', $user )}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input 
                                    type="submit" 
                                    class="bg-gray-400 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Unfollow" />
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <section>
        <h2 class="text-4xl text-center font-black my-10 dark:text-white">POSTS</h2>

        <x-listar-post :posts="$posts" />

    </section>

@endsection
