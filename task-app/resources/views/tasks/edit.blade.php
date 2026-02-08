@extends('layout')

@section('content')
<h2>タスク編集</h2>

<form action="{{ route('tasks.update', $task) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">タイトル</label>
        <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">詳細</label>
        <textarea name="description" class="form-control">{{ $task->description }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">期限</label>
        <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}">
    </div>

    <button class="btn btn-primary">更新</button>
</form>
@endsection
