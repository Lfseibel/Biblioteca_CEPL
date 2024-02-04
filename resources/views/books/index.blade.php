@extends('layouts.app')

@section('title', 'Listagem dos Livros')

@section('content')

<a href="{{ route('index') }}" class="bg-black rounded-full text-white px-8 py-2 text-xl">Menu Inicial</a>
<h1 class="text-2xl font-semibold leading-tigh py-2">
    Listagem dos Livros
    <a href="{{ route('books.create') }}" class="bg-blue-900 rounded-full text-white px-6 py-2 text-sm">+</a>
</h1>

<form action="{{ route('books.index') }}" method="get" class="py-5">
    <input type="text" name="name" placeholder="Nome" class="md:w-1/6 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
    <input type="text" name="author" placeholder="Autor" class="md:w-1/6 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
    <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Pesquisar</button>
</form>

<table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
    <thead>
        <tr>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Numero
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Nome
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Genero
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Visualizar
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Editar
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Emprestar
          </th>
        </tr>
      </thead>
      <tbody>
        
    @foreach ($books as $book)
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              {{$book->author->number}}.{{$book->number}}
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $book->name  }}</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $book->gender  }} </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="{{ route('books.show', $book->id) }}" class="bg-green-200 rounded-full py-2 px-6">Ver</a>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="{{ route('books.edit', $book->id) }}" class="bg-orange-200 rounded-full py-2 px-6">Editar</a>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              @if ($book->reservations->isNotEmpty() && $book->reservations->last()->reserved)
                  <a href="{{ route('reservations.index', ['user_name' => $book->reservations->last()->user_name]) }}" class="bg-red-200 rounded-full py-2 px-6">Já emprestado</a>
              @else
                  <a href="{{ route('reservations.create', $book->id) }}" class="bg-blue-200 rounded-full py-2 px-6">Emprestar </a>
              @endif
              
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="py-4">
  {{$books->appends(['name'=> request()->get('name', ''), 'author'=> request()->get('author', '')])->links()}}
</div>

@endsection