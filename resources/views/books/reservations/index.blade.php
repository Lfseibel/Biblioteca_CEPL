@extends('layouts.app')

@section('title', 'Listagem dos Empréstimos')

@section('script')
<link href="
{{asset("./css/sweetalert.css")}}
" rel="stylesheet">
<script src="{{asset("./js/sweetalert.js")}}"></script>
<script src="{{asset("./js/reserva.js")}}"></script>
@endsection

@section('content')

<a href="{{ route('index') }}" class="bg-black rounded-full text-white px-8 py-2 text-xl">Menu Inicial</a>
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
            Numero
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
            Devolver
          </th>
        </tr>
      </thead>
      <tbody>
    @foreach ($reservations as $reservation)
        <tr >
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $reservation->book->author->number  }}.{{ $reservation->book->number  }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $reservation->book->name  }}</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $reservation->user_name  }}</td>
            @if (Carbon\Carbon::parse(Carbon\Carbon::now()->format('F j, Y H:i:s'))->gt(Carbon\Carbon::parse($reservation->devolutionDate)))
            <td class="px-5 py-5 border-b border-gray-200 bg-red-300 text-sm">
              Atrasado

            </td>
                
              @else
              <td class="px-5 py-5 border-b border-gray-200 bg-green-300 text-sm">
                Em dia
  
              </td>
            @endif
            
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <input type="date" value="{{ $reservation->devolutionDate  }}" readonly>
              
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <form id="{{$reservation->id}}" data-user_name="{{$reservation->user_name}}" class="" action="{{route('reservations.edit', $reservation->id)}}" method="post" enctype="multipart/form-data"> 
                @csrf
                @method('PUT')
                <button type="button" class="edit-button bg-blue-200 rounded-full py-2 px-6">Devolver </button>
                
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