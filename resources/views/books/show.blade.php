@extends('layouts.app')

@section('title', 'Listagem do Livro')

@section('script')
<link href="
{{asset("./css/sweetalert.css")}}
" rel="stylesheet">
<script src="{{asset("./js/sweetalert.js")}}"></script>
<script src="{{asset("./js/livros.js")}}"></script>
@endsection

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Listagem do livro {{ $book->name }}</h1>

<ul>
    <li>{{ $book->name }}</li>
    <li>{{ $book->author->name }}</li>
    <li>{{ $book->year }}</li>
    <li>{{ $book->gender }}</li>
    <li>Numero: {{ $book->number }}</li>
</ul>
<h2>Reservas:</h2>
<ul>
    @foreach ($book->reservations as $reservation)
        <li>{{$reservation->id}} - {{$reservation->user_name}} - @if ($reservation->reserved == 1)
            Emprestado
            @else
            Devolvido
        @endif </li>
    @endforeach
</ul>
<form data-name="{{$book->name}}" action="{{ route('books.destroy', $book->id) }}" method="POST" class="py-12">
    @method('DELETE')
    @csrf
    <button type="button" class="delete-button rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
</form>

@endsection