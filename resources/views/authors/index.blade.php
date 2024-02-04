@extends('layouts.app')

@section('title', 'Listagem dos Autores')

@section('script')
<link href="
{{asset("./css/sweetalert.css")}}
" rel="stylesheet">
<script src="{{asset("./js/sweetalert.js")}}"></script>
<script src="{{asset("./js/autor.js")}}"></script>
@endsection

@section('content')
  <a href="{{ route('index') }}" class="bg-black rounded-full text-white px-8 py-2 text-xl">Menu Inicial</a>
<h1 class="text-2xl font-semibold leading-tigh py-2">
    Listagem dos Autores
    <a href="{{ route('authors.create') }}" class="bg-blue-900 rounded-full text-white px-6 py-2 text-sm">+</a>
</h1>

<form action="{{ route('authors.index') }}" method="get" class="py-5">
    <input type="text" name="name" placeholder="Nome" class="md:w-1/6 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
    <input type="text" name="number" placeholder="Numero" class="md:w-1/6 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
    <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Pesquisar</button>
</form>

<table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
    <thead>
        <tr>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Nome
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Numero
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Livros
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Deletar
          </th>
        </tr>
      </thead>
      <tbody>
    @foreach ($authors as $author)
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $author->name  }}</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $author->number  }}</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="{{ route('books.index', ['author' => $author->name]) }}" class="bg-green-200 rounded-full py-2 px-6">Livros</a>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <form data-name="{{$author->name}}" class="" action="{{route('authors.destroy', $author->id)}}" method="post" enctype="multipart/form-data"> 
                @csrf
                @method('DELETE')
                <button type="button" class="delete-button text-white bg-red-500 hover:bg-red-700 rounded-full py-2 px-6">Deletar </button>
                
              </form>
          </td>
            
        </tr>
    @endforeach
    </tbody>
</table>

<div class="py-4">
  {{$authors->appends(['name'=> request()->get('name', ''), 'number'=> request()->get('number', '')])->links()}}
</div>

@endsection