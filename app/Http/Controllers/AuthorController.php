<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    protected $model;

    public function __construct(Author $author)
    {
        $this->model = $author;
    }

    public function index(Request $request)
    {
        //$search = $request->search;
        //$users = $this->model->where('name', 'LIKE', "%{$request->search}%")->get();
        $authors = $this->model->where('name', 'LIKE', "%{$request->name}%")->where('number', 'LIKE', "%{$request->number}%")->orderBy('name', 'asc')->paginate(20);
        return view('authors.index', compact('authors'));
    }

    public function show($id)
    {
        if(!$author = $this->model->find($id))
        {
            return redirect()->route('authors.index');
        }
        
        return view('authors.show', compact('author'));
    }

    public function create()
    {
        return view('authors.create');
    } 

    public function store(AuthorRequest $request)
    {
        $data = $request->all();

        $this->model->create($data);

        return redirect()->route('authors.index');
    }

    public function edit($id)
    {
        if(!$author = $this->model->find($id))
        {
            return redirect()->route('authors.index');
        }
        return view('authors.edit', compact('author'));
    }

    

    public function update(AuthorRequest $request, $id)
    {
        if(!$author = $this->model->find($id))
        {
            return redirect()->route('books.index');
        }
        $data = $request->only('name', 'number');

        $author->update($data);

        return redirect()->route('authors.index');
    }

    public function destroy($id)
    {
        if(!$author = $this->model->find($id))
        {
            return redirect()->route('authors.index');
        }
        
        $author->delete();

        return redirect()->route('authors.index');
    }
}
