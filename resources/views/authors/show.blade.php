@extends('layouts.app')

@section('title', 'Listagem do Livro')

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Listagem do Autor {{ $author->name }}</h1>

<ul>
    <li>{{ $author->name }}</li>
    <li>{{ $author->number }}</li>
</ul>

<form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="py-12">
    @method('DELETE')
    @csrf
    <button type="submit" class="rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
</form>

@endsection