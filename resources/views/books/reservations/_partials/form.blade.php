<div class="w-full bg-white shadow-md rounded px-8 py-12">
  @csrf
  <label class="block mb-2">Emprestar para</label>
  <select
                data-placeholder="Choose a Country..."
                class="w-full chosen-select"
                tabindex="2"
                name="user_name"
              >
 
            @if ($users)
              @foreach ($users as $user)
                <option value="{{ $user->name}}" selected>{{$user->name}} </option>
              @endforeach
            @endif
            <option value="{{ $reservation->user_name ?? old('user_name') ??NULL }}" selected>{{$reservation->user ?? old('user_name') ??'Escolha o usuario'}} </option>
  </select>
  <label class="block mt-4">Data de devolução</label>
  <input type="date" name="devolutionDate" value="{{ old('date', Carbon\Carbon::now()->addDays(15)->format('Y-m-d')) }}" class="shadow mb-4 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">

  <button type="submit" class="w-full shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold mt-4 py-2 px-4 rounded">
      Enviar
  </button>
  <script
            src="{{asset('docsupport/jquery-3.2.1.min.js')}}"
            type="text/javascript"
          ></script>
          <script src="{{asset('chosen.jquery.js')}}" type="text/javascript"></script>
          <script
            src="{{asset('docsupport/prism.js')}}"
            type="text/javascript"
            charset="utf-8"
          ></script>
          <script
            src="{{asset('docsupport/init.js')}}"
            type="text/javascript"
            charset="utf-8"
          ></script>
</div>