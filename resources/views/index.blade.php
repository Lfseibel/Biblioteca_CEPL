<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body >
    <div class="flex align-center justify-center justify-around between h-screen mt-40 text-6xl ">
    <a href="{{ route('books.index')}}"> Livros </a>
    <a href="{{ route('users.index')}}"> Usuarios </a>
    <a href="{{ route('reservations.index')}}"> Empréstimos </a>
  </div>
  </body>
</html>
