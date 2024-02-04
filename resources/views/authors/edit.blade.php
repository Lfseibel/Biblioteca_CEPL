@extends('layouts.app')

@section('title', "Editar o autor {$author->name}")

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Editar o Autor {{ $author->name }}</h1>

@include('includes.validation-form')

<form action="{{ route('authors.update', $author->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @include('authors._partials.form')
</form>

@endsection