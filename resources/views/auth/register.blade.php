@extends('layouts.app')

@section('titulo')
    Create an account on DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <!-- asset apunta directo hacia la carpeta public -->
            <img src="{{ asset('img/registrar.jpg') }}" alt="User register image">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form>
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Name
                    </label>
                    <input class="border p-3 w-full rounded-lg" id="name" name="name" type="text" placeholder="Your name"/>
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nickname
                    </label>
                    <input id="username" name="username" type="text" placeholder="Your nickname" class="border p-3 w-full rounded-lg"/>
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email" name="email" type="email" placeholder="Your email" class="border p-3 w-full rounded-lg"/>
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input id="password" name="password" type="password" placeholder="Create a secure password" class="border p-3 w-full rounded-lg"/>
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                       Password Confirmation
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Repeat your password" class="border p-3 w-full rounded-lg"/>
                </div>
                <input type="Submit" value="Register" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"/>
            </form>
        </div>

    </div>
    
@endsection