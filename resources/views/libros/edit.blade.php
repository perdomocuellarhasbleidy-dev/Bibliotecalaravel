@extends('layouts.app')

@section('title', 'Editar libro')

@section('content')

<h1>Editar libro</h1>

<br>

<form
    action="{{ route('libros.update', $libro) }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    @method('PUT')

    @php
        $boton = 'Actualizar libro';
    @endphp

    @include('libros.form')

</form>

@endsection