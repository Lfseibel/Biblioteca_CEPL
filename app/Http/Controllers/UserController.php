<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index(Request $request)
    {
        //$search = $request->search;
        //$users = $this->model->where('name', 'LIKE', "%{$request->search}%")->get();
        $users = $this->model->where('name', 'LIKE', "%{$request->search}%")->paginate(10);
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        if(!$user = $this->model->find($id))
        {
            return redirect()->route('users.index');
        }
        
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    } 

    public function store(UserRequest $request)
    {
        $data = $request->all();

        if($request->image)
        {
            $data['image'] = $request->image->store('users');
        }

        $this->model->create($data);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        if(!$user = $this->model->find($id))
        {
            return redirect()->route('users.index');
        }
        return view('users.edit', compact('user'));
    }

    

    public function update(UserRequest $request, $id)
    {
        if(!$user = $this->model->find($id))
        {
            return redirect()->route('users.index');
        }
        $data = $request->only('name', 'year', 'gender', 'author');


        $user->update($data);

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        if(!$user = $this->model->find($id))
        {
            return redirect()->route('users.index');
        }
        
        $user->delete();

        return redirect()->route('users.index');
    }

    public function reserve($id)
    {
        if(!$user = $this->model->find($id))
        {
            return redirect()->route('users.index');
        }
   
        $users = User::all();
        
        return view('users.reserve', [compact('user'), compact('users')]);
    }
}
