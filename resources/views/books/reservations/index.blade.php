@extends('layouts.app')

@section('title', 'Listagem dos Empréstimos')

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">
    Listagem dos empréstimos
</h1>

<form action="{{ route('reservations.index') }}" method="get" class="py-5">
    <input type="text" name="user_name" placeholder="Nome" class="md:w-1/6 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
    <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Pesquisar</button>
</form>

<table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
    <thead>
        <tr>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Imagem
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Livro
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Pessoa
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Estado
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Data de devolução
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Editar
          </th>
        </tr>
      </thead>
      <tbody>
    @foreach ($reservations as $reservation)
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              <img src="{{ url("storage/{$reservation->book->image}")}}" alt=" {{ $reservation->book->name }}" class="object-cover w-20">
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $reservation->book->name  }}</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $reservation->user_name  }}</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              @if (Carbon\Carbon::parse(Carbon\Carbon::now()->format('F j, Y H:i:s'))->gt(Carbon\Carbon::parse($reservation->devolutionDate)))
                Atrasado
              @else
                Em dia
              @endif

            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <input type="date" value="{{ $reservation->devolutionDate  }}" readonly>
              
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <form action="{{route('reservations.edit', $reservation->id)}}" method="post" enctype="multipart/form-data"> 
                @csrf
                @method('PUT')
                <button class="bg-blue-200 rounded-full py-2 px-6">Devolver </button>
                
              </form>
              
          </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="py-4">
  {{$reservations->appends(['user_name'=> request()->get('user_name', '')])->links()}}
</div>

@endsection