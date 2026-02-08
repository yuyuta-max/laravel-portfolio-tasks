@extends('layout')

@section('content')
<h2>新規タスク作成</h2>

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">タイトル</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">詳細</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">期限</label>
        <input type="date" name="due_date" class="form-control">
    </div>

    <button class="btn btn-primary">保存</button>
</form>
@endsection
