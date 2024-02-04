<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\ReservationRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    protected $model;

    public function __construct(Book $book)
    {
        $this->model = $book;
    }

    public function index(Request $request)
    {
        //$search = $request->search;
        //$users = $this->model->where('name', 'LIKE', "%{$request->search}%")->get();
        if($request->author && $author = Author::where('name', 'LIKE', "%{$request->author}%")->latest()->first())
        {
            $books = $this->model->where('name', 'LIKE', "%{$request->name}%")->where('author_id', 'LIKE', "%{$author->id}%")->orderBy('name', 'asc')->paginate(20); 
        }
        else
        {
            $books = $this->model->where('name', 'LIKE', "%{$request->name}%")->orderBy('name', 'asc')->paginate(20);
            
        }
        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        if(!$book = $this->model->find($id))
        {
            return redirect()->route('books.index');
        }
        return view('books.show', compact('book'));
    }

    public function create()
    {
        $authors = Author::get();

        return view('books.create', compact('authors'));
    } 

    public function store(BookRequest $request)
    {
        $data = $request->all();
        $test = Author::where('id', 'LIKE', "%{$data['author_id']}%")->get()->last();
        
        if(!$test->books()->count())
        {
            $data['number'] = '001';
        }
        else
        {
            $data['number'] = $test->books()->count();

            // Remove leading zeros and convert to integer
            $intValue = (int) ltrim($data['number'], '0');

            // Increment the value
            $newValue = $intValue + 1;

            // Format the new value with leading zeros
            $formattedValue = sprintf('%03d', $newValue);

            $data['number'] = $formattedValue;
        }
        $this->model->create($data);

        return redirect()->route('books.index');
    }

    public function edit($id)
    {
        if(!$book = $this->model->find($id))
        {
            return redirect()->route('books.index');
        }
        $authors = Author::get();
        return view('books.edit', compact('book','authors'));
    }

    

    public function update(BookRequest $request, $id)
    {
        if(!$book = $this->model->find($id))
        {
            return redirect()->route('books.index');
        }
        $data = $request->only('name', 'year', 'gender', 'author_id');

        if($request->image)
        {
           if($book->image && Storage::exists($book->image))
           {
                Storage::delete($book->image);
           } 
            $data['image'] = $request->image->store('users');   #uma forma possivel de dar upload (retorna o path no data image)
        }

        $book->update($data);

        return redirect()->route('books.index');
    }

    public function destroy($id)
    {
        if(!$user = $this->model->find($id))
        {
            return redirect()->route('users.index');
        }
        
        $user->delete();

        return redirect()->route('books.index');
    }

    public function reserve($id)
    {
        if(!$book = $this->model->find($id))
        {
            return redirect()->route('books.index');
        }
        $users = User::all();
        
        return view('books.reservations.create', compact('book', 'users'));
    }

    public function reserveStore(ReservationRequest $request, $book_id)
    {
        if(!$book = $this->model->find($book_id))
        {
            return redirect()->route('books.index');
        }
        $u = new User;
        $user = $u->where('name', 'LIKE', "%{$request->user_name}%")->get()->first();

        $data = $request->all();
        $data['book_id'] = $book_id;
        
        $r = new Reservation;
        
        $check = $r->where('book_id', 'LIKE', "{$book_id}")->get()->last();
        if($check)
        {
            if($check->reserved)
            {
                return redirect()->back()->withErrors('Livro já emprestado no momento');
            }
        }
        
        
        $r->create($data);
       
        return redirect()->route('reservations.index');
    }

    public function reserveIndex(Request $request)
    {
        //$search = $request->search;
        //$users = $this->model->where('name', 'LIKE', "%{$request->search}%")->get();
        $r = new Reservation;
        $reservations = $r->where('user_name', 'LIKE', "%{$request->user_name}%")->where('reserved', '1')->orderBy('user_name', 'asc')->paginate(20);
        
        return view('books.reservations.index', compact('reservations'));
    }

    public function reserveEdit($id)
    {
        $r = new Reservation;
        if(!$reserve = $r->find($id))
        {
            return redirect()->route('reservations.index');
        }
        $data['reserved'] = 0;


        $reserve->update($data);

        return redirect()->route('reservations.index');
    }
}
