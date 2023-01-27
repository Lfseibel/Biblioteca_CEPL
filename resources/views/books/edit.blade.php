@extends('layouts.app')

@section('title', "Editar o livro {$book->name}")

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Editar o Livro {{ $book->name }}</h1>

@include('includes.validation-form')

<form action="{{ route('books.update', $book->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @include('books._partials.form')
</form>

@endsection