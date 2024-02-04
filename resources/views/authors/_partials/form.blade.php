<div class="w-full bg-white shadow-md rounded px-8 py-12">
  @csrf
  <input type="text" name="name" placeholder="Nome:" value="{{ $author->name ?? old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="number" name="number" placeholder="Número:" value="{{ $author->number ?? old('number') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <button type="submit" class="w-full shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
      Enviar
  </button>
</div>