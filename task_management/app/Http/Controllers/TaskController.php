<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::get();
        return view("index", compact("tasks"));
    }

    public function create()
    {
        $statues = [
            [
                'label' => 'ToDo',
                'value' => 'ToDo',
            ],
            [
                'label' => 'Done',
                'value' => 'Done',
            ]
            ];
       return view('create', compact('statues'));
    }

    public function store(Request $request)
    {
       $request->validate([
        'title'=> 'required',
       ]);

       $task = new Task();
       $task->title = $request->title;
       $task->description = $request->description;
       $task->status = $request->status;

       $task->save();

       return redirect()->route('index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $statues = [
            [
                'label' => 'ToDo',
                'value' => 'ToDo',
            ],
            [
                'label' => 'Done',
                'value' => 'Done',
            ]
            ];
       return view('edit', compact('statues','task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $request->validate([
            'title'=> 'required',
           ]);
    
           //$task = new Task();
           $task->title = $request->title;
           $task->description = $request->description;
           $task->status = $request->status;
           $task->save();
    
           return redirect()->route('index');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('index');
    }
    
}
