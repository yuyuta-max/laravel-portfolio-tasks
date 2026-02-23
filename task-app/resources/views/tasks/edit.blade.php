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



        <div class="mb-3">
            <label class="form-label">優先度</label>
            <select name="priority" class="form-control">
                <option value="high">高</option>
                <option value="medium" selected>中</option>
                <option value="low">低</option>
            </select>
        </div>



        @php
            $color = [
                'high' => 'danger',
                'medium' => 'warning',
                'low' => 'secondary',
            ][$task->priority];
        @endphp

        <span class="badge bg-{{ $color }}">
            {{ strtoupper($task->priority) }}
        </span>

        
        <div>
            <label class="font-bold">共有するユーザー</label>
            <div class="mt-2">
                @foreach (\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                    <label class="block">
                        <input type="checkbox" name="shared_users[]" value="{{ $user->id }}"
                            {{ $task->sharedUsers->contains($user->id) ? 'checked' : '' }}>
                        {{ $user->name }}
                    </label>
                @endforeach
            </div>
        </div>










    </form>
@endsection
