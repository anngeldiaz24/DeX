<!-- Directiva en blade que apunta a las vistas-->
@extends('layouts.app')

<!-- Con la directiva yield(titulo) en app.blade.php hace referencia -->
@section('titulo')
    HOME
@endsection

@section('contenido')
    
    {{-- We are send the posts variable to the
    component --}}
    <x-listar-post :posts="$posts" />
    
@endsection

