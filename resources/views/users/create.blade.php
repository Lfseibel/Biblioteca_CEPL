@extends('layouts.app')

@section('title', 'Novo usuário')


@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Novo usuário</h1>

@include('includes.validation-form')

<form action="{{route('users.store')}}" method="post" enctype="multipart/form-data"> 
  {{-- enctype é pra upload de arquivos funcionar --}}
  @include('users._partials.form')
</form>
@endsection