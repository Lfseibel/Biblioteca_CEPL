@extends('layouts.app')

@section('title', 'Novo autor')

<a href="{{ route('authors.index')}}"> Voltar </a>
@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Novo autor</h1>

@include('includes.validation-form')

<form action="{{route('authors.store')}}" method="post" enctype="multipart/form-data"> 
  {{-- enctype é pra upload de arquivos funcionar --}}
  @include('authors._partials.form')
</form>
@endsection