<div class="w-full bg-white shadow-md rounded px-8 py-12">
  @csrf
  <input type="text" name="name" placeholder="Nome:" value="{{ $book->name ?? old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="text" name="author" placeholder="Autor:" value="{{ $book->author ?? old('author') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="text" name="year" placeholder="Ano:" value="{{ $book->year ?? old('year') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="file" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <select name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 my-2 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value="{{ $book->gender ?? NULL }}" selected>{{$book->gender ?? 'Escolha o genero'}} </option>
    <option value="Filosofia">Filosofia</option>
    <option value="Romance">Romance</option>
    <option value="Obras Basicas">Obras Básicas</option>
    <option value="Mensagens">Mensagens</option>
  </select>
  <button type="submit" class="w-full shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
      Enviar
  </button>
</div>