@extends('layouts.app')

@section('title', 'Novo livro')


@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Novo livro</h1>

@include('includes.validation-form')

<form action="{{route('books.store')}}" method="post" enctype="multipart/form-data"> 
  {{-- enctype é pra upload de arquivos funcionar --}}
  @include('books._partials.form')
</form>
@endsection