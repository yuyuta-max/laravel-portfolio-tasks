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
            <label class="form-label">タグ</label>
            <select name="tags[]" class="form-control" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">優先度</label>
            <select name="priority" class="form-control">
                <option value="high">高</option>
                <option value="medium" selected>中</option>
                <option value="low">低</option>
            </select>
        </div>

        @foreach ($task->tags as $tag)
            <span class="badge" style="background: {{ $tag->color ?? '#888' }}">
                {{ $tag->name }}
            </span>
        @endforeach

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

        <div class="mb-3">
            <label class="form-label">タグ</label>
            <select name="tags[]" class="form-control" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ $task->tags->contains($tag->id) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>







    </form>
@endsection
