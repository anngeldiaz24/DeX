@extends('layouts.app')

@section('titulo')
    Edit Profile: {{ auth()->user()->username }}
@endsection


@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6 dark:bg-zinc-900 rounded">
            @if (session('mensaje'))
                <div class="bg-red-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                    {{ session('mensaje') }}
                </div>
            @endif
            <form method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold dark:text-white">
                        Username
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" 
                        id="username" 
                        name="username" 
                        type="text" 
                        placeholder="Your username" 
                        value="{{ auth()->user()->username }}"/>
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold dark:text-white">
                        Profile Picture
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg"
                        id="imagen" 
                        name="imagen" 
                        type="file" 
                        value=""
                        accept=".jpg, .jpge, .png"/>
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold dark:text-white">
                        Email
                    </label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        placeholder="Your email" 
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ auth()->user()->email }}"/>
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="oldpassword" class="mb-2 block uppercase text-gray-500 font-bold dark:text-white">
                        Password
                    </label>
                    <input 
                        id="oldpassword" 
                        name="oldpassword" 
                        type="password" 
                        placeholder="Type your current password" 
                        class="border p-3 w-full rounded-lg @error('oldpassword') border-red-500 @enderror"/>
                        @error('oldpassword')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold dark:text-white">
                       Introduce your new Password
                    </label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        placeholder="Change your password" 
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"/>
                        @error('password')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold dark:text-white">
                       Password Confirmation
                    </label>
                    <input 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        placeholder="Repeat your password" 
                        class="border p-3 w-full rounded-lg"/>
                </div>
                <input type="Submit" value="Save" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"/>
            </form>
        </div>
    </div>

@endsection