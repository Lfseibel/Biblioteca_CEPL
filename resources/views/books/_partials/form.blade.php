<div class="w-full bg-white shadow-md rounded px-8 py-12">
  @csrf
  <input type="text" name="name" placeholder="Nome:" value="{{ $book->name ?? old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <select name="author_id" class="bg-gray-50 border border-gray-300 text-gray-900 my-2 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value="{{ $book->author_id ?? old('author_id') ?? NULL }}" selected>{{$book->author->name ?? old('author_id') ?? 'Escolha o autor'}} </option>
    @foreach ($authors as $author)
      <option value="{{$author->id}}">{{$author->name}}</option>
    @endforeach
  </select>
  <input type="text" name="year" placeholder="Ano:" value="{{ $book->year ?? old('year') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  
  <select name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 my-2 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value="{{ $book->gender ??  old('gender') ?? NULL }}" selected>{{$book->gender ?? old('gender') ?? 'Escolha o genero'}} </option>
    <option value="Obras basicas">Obras basicas</option>
    <option value="Estudos">Estudos</option>
    <option value="Cronicas">Cronicas</option>
    <option value="Contos">Contos</option>
    <option value="Biografia">Biografia</option>
    <option value="Entrevistas">Entrevistas</option>
    <option value="Filosofia">Obras Básicas</option>
    <option value="Mensagens">Mensagens</option>
    <option value="Romance">Romance</option>
    <option value="Cartas">Cartas</option>
    <option value="Poesia">Poesia</option>
    <option value="Narrativas pessoais">Narrativas pessoais</option>
    <option value="Outros">Outros</option>
  </select>
  <button type="submit" class="w-full shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
      Enviar
  </button>
</div>