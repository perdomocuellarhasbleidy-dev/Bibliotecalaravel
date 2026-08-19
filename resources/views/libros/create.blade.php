@extends('layouts.app')

@section('title', 'Registrar libro')

@section('content')

<h1>Registrar libro</h1>

<br>

<form
    action="{{ route('libros.store') }}"
    method="POST">

    @csrf

    @php
        $libro = null;
        $boton = 'Guardar libro';
    @endphp

    @include('libros.form')

</form>

@endsection