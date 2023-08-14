<!DOCTYPE html>
<script setup>
    
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark')
    } else {
    document.documentElement.classList.remove('dark')
    }

    const changeDarkMode = () => {
        document.documentElement.classList.toggle("dark");
    } 
</script>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DeX - @yield('titulo')</title>
        @stack('styles')
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles()
    </head>
    
    <body class="bg-gray-100 dark:bg-black dark:text-white:not(.dropzone)">
        <header class="p-5 border-b shadow">
            <div class="container mx-auto flex justify-between items-center dark:text-white">
                <a href="{{ route('home') }}"class="text-3xl font-black">
                    DeX
                </a>
            
                
                <!-- This verified if the user is already authenticated-->
                @auth
                    {{-- <p>Autenticado</p> --}}
                    <nav class="flex gap-2 items-center">
                        <button class="py-4 px-4 dark:text-white" onclick="changeDarkMode()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                              </svg>                              
                        </button>
                        <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer"
                        href="{{ route('posts.create') }}">
                            <!-- Icon from heroicons.com -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>  
                            Create
                        </a>
                        <a class= "font-bold text-gray-600 text-sm dark:text-white" 
                        href="{{ route('posts.index', auth()->user()->username ) }}">Hello: 
                            <span class="font-normal">
                                {{ auth()->user()->username }}
                            </span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="font-bold uppercase text-gray-600 text-sm dark:text-white">LogOut</button>
                        </form>
                    </nav>
                @endauth
                
                @guest
                    {{-- <p>No autenticado</p> --}}
                    <nav class="flex gap-2 items-center">
                        <button class="py-4 px-4 dark:text-white" onclick="changeDarkMode()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                              </svg>                              
                        </button>
                        <a class= "font-bold uppercase text-gray-600 text-sm dark:text-white" href="{{ route('login') }}">Login</a>
                        <!--Route allows us to change a route but its name will be the same as the file web.php-->
                        <a class= "font-bold uppercase text-gray-600 text-sm dark:text-white" href="{{ route('create-account') }}">Sign Up</a>
                    </nav>
                @endguest

                    
            </div>
        </header>
        <!-- Here we will insert the content of the views-->
        <main class ="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10 dark:text-white">
                @yield('titulo')
            </h2>
            <!-- Yield plays a role as a container -->
            @yield('contenido')
        </main>

        <!--FOOTER-->
        <footer class="mt-10 text-center p-5 text-gray-500 font-bold dark:text-white">
            Copyright © {{ now()->year }} DeX. All rights reserved.
        </footer>

        @livewireScripts()
    </body>

</html>
