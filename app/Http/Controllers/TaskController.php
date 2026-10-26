<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
        ]);
        Task::create(
            [
                'title' => $request->title,
                'is_done' => $request->boolean('is_done'),
            ]
        );
        return redirect()->route('tasks.index');
    }

    public function update(Request $request, Task $task)
    {
        Task::where('id', $task->id)->update([
            'title' => $request->title,
            'is_done' => $request->boolean('is_done'),
        ]);
        return redirect()->route('tasks.index');
    }
    public function destroy(Task $task)
    {
        Task::destroy($task->id);
        return redirect()->route('tasks.index');
    }

    public function toggle(Task $task)
    {
        Task::where('id', $task->id)->update(['is_done' => !$task->is_done]);
        return redirect()->route('tasks.index');
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' =>$task]);
    }

}
