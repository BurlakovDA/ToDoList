<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::user()->id)->orderBy('created_at')->get();
        return view('home', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'isDone' => 'nullable'
        ]);

        $task = new Task;
        $task->name = $request->input('name');
        $task->description = $request->input('description');

        if($request->has('isDone')){
            $task->isDone = true;
        }

        $task->user_id = Auth::user()->id;
        $task->save();

        return back()->with('success', "ToDos successfully added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        if(!$task){
            abort(404);
        }
        return view('tasks/delete', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if(!$task){
            abort(404);
        }
        return view('tasks/edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'isDone' => 'nullable'
        ]);

        $task = Task::find($id);
        $task->name = $request->input('name');
        $task->description = $request->input('description');

        if($request->has('isDone')){
            $task->isDone = true;
        }else{
            $task->isDone = false;
        }

        $task->save();

        return back()->with('success', "ToDos successfully update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $task->delete();
        return redirect()->route('task.index')->with('success', 'ToDos successfully deleted');
    }
}
