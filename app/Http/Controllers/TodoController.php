<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * View todo index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $userID = Auth::id();
        $todos = Todo::where('user_id', $userID)->get();
        return view('todo.index', compact('todos'));
    }

    /**
     * Add new todo
     *
     * @param TodoRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TodoRequest $request)
    {
        $todo = new Todo;
        $todo->content = $request->todo;
        $todo->user_id = Auth::id();
        $todo->save();
        return redirect('todo');
    }

    /**
     * Done or back todo
     *
     * @param Todo $todo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Todo $todo)
    {
        if($todo->done){
            $todo->done = false;
        }else{
            $todo->done = true;
        }
        $todo->save();
        return redirect('todo');
    }

    /**
     * Delete todo
     *
     * @param Todo $todo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect('todo');
    }

}
