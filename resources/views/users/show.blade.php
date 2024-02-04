@extends('layouts.app')

@section('title', 'Listagem do Usuario')

@section('script')
<link href="
{{asset("./css/sweetalert.css")}}
" rel="stylesheet">
<script src="{{asset("./js/sweetalert.js")}}"></script>
<script src="{{asset("./js/usuarios.js")}}"></script>
@endsection

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Listagem do Usuario {{ $user->name }}</h1>

<ul>
    <li>{{ $user->name }}</li>
    <li>{{ $user->addres }}</li>
    <li>{{ $user->contactNumber }}</li>
    <li>{{ $user->birthDate }}</li>
</ul>

<form data-name="{{$user->name}}" action="{{ route('users.destroy', $user->id) }}" method="POST" class="py-12">
    @method('DELETE')
    @csrf
    <button type="button" class="delete-button rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
</form>

@endsection