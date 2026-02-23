<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->orWhereHas('sharedUsers', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->orderBy('due_date')
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'priority' => 'required|string',
            'shared_users' => 'array',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'is_done' => false,
            'user_id' => auth()->id(),
        ]);

        if ($request->shared_users) {
            $task->sharedUsers()->sync($request->shared_users);
        }

        return redirect()->route('tasks.index')->with('success', 'タスクを追加しました');
    }


    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id() && !$task->sharedUsers->contains(auth()->id())) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }


    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id() && !$task->sharedUsers->contains(auth()->id())) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'priority' => 'required|string',
            'shared_users' => 'array',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
        ]);

        // 共有ユーザー更新
        $task->sharedUsers()->sync($request->shared_users ?? []);

        return redirect()->route('tasks.index')->with('success', 'タスクを更新しました');
    }


    public function destroy(Task $task)
    {

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'タスクを削除しました');
    }

    public function toggle(Task $task)
    {

        if ($task->user_id !== auth()->id() && !$task->sharedUsers->contains(auth()->id())) {
            abort(403);
        }
        $task->is_done = !$task->is_done;
        $task->save();

        return redirect()->route('tasks.index');
    }
}
