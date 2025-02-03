<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()
    {
       $todos = Todo::All(); 
       return view('index', ['todos' => $todos]);
    }

    public function store(TodoRequest $request)
    {
        $todo = $request->only(['content']);
        Todo::create($todo);
        return redirect('/')->with('message', 'Todoを作成しました');
    }

    public function update(Request $request)
    {
        $todo = $request->all();
        unset($todo['_token']);
        Todo::find($request->id)->update($todo);
        return redirect('/');
    }

    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/');
    }
}
