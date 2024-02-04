@extends('layouts.app')

@section('title', 'Novo usuário')


@section('content')
<a href="{{ route('users.index')}}"> Voltar </a>
<h1 class="text-2xl font-semibold leading-tigh py-2">Novo usuário</h1>

@include('includes.validation-form')

<form action="{{route('users.store')}}" method="post" enctype="multipart/form-data"> 
  {{-- enctype é pra upload de arquivos funcionar --}}
  @include('users._partials.form')
</form>
@endsection