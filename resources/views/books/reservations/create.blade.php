@extends('layouts.app')

@section('title', 'Nova Reserva')

<link rel="stylesheet" href="{{asset('chosen.css')}}" />
@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Novo empréstimo para o livro {{$book->name}}</h1>

@include('includes.validation-form')

<form action="{{route('reservations.store', $book->id)}}" method="post" enctype="multipart/form-data"> 
  {{-- enctype é pra upload de arquivos funcionar --}}
  @include('books.reservations._partials.form')
  
</form>


@endsection