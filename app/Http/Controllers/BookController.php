<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\ReservationRequest;
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
        $books = $this->model->where('name', 'LIKE', "%{$request->name}%")->where('author', 'LIKE', "%{$request->author}%")->paginate(20);
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
        return view('books.create');
    } 

    public function store(BookRequest $request)
    {
        $data = $request->all();

        if($request->image)
        {
            $data['image'] = $request->image->store('users');
        }
        
        if(!$test = $this->model->where('gender', 'LIKE', "%{$data['gender']}%")->get()->last())
        {
            $data['number'] = 1;
        }
        else
        {
            $data['number'] = $test->number+1;
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
        return view('books.edit', compact('book'));
    }

    

    public function update(BookRequest $request, $id)
    {
        if(!$book = $this->model->find($id))
        {
            return redirect()->route('books.index');
        }
        $data = $request->only('name', 'year', 'gender', 'author');

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
        $reservations = $r->where('user_name', 'LIKE', "%{$request->user_name}%")->where('reserved', '1')->paginate(20);
        
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
