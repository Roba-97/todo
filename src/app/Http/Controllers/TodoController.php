<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()
    {
        //  マジックメソッド __call
       // $todos = Todo::All();
       $todos = Todo::all(); 
       return view('index', ['todos' => $todos]);
    }

    public function store(TodoRequest $request)
    {
        $todo = $request->only(['content']);
        Todo::create($todo);
        // Todo::create($request->only(['content']));
        return redirect('/')->with('message', 'Todoを作成しました');
    }

    public function update(Request $request, Todo $todo)
    {
        // $todo = $request->all();

        // unset($todo['_token']);
        $todo->update($request->all());
        return redirect('/')->with('message', 'Todoを更新しました');;
    }

    public function destroy(Request $request)
    {
        // findOrFail
        Todo::find($request->id)->delete();
        return redirect('/')->with('message', 'Todoを削除しました');;
    }
}
