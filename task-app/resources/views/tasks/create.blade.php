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


        <div class="mb-3">
            <label class="form-label">優先度</label>
            <select name="priority" class="form-control">
                <option value="high">高</option>
                <option value="medium" selected>中</option>
                <option value="low">低</option>
            </select>
        </div>

        <div>
            <label class="font-bold">共有するユーザー</label>
            <div class="mt-2">
                @foreach (\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                    <label class="block">
                        <input type="checkbox" name="shared_users[]" value="{{ $user->id }}">
                        {{ $user->name }}
                    </label>
                @endforeach
            </div>
        </div>







    </form>
@endsection
