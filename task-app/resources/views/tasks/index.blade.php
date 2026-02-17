@extends('layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>タスク一覧</h2>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">＋ 新規タスク</a>
    </div>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>完了</th>
                <th>タイトル</th>
                <th>期限</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>
                        <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="checkbox" onChange="this.form.submit()" {{ $task->is_done ? 'checked' : '' }}>
                        </form>
                    </td>
                    <td class="{{ $task->is_done ? 'text-decoration-line-through' : '' }}"
                        style="background-color: {{ $task->priorityColor() }};">
                        {{ $task->title }}
                    </td>

                    <td>{{ $task->due_date }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">編集</a>

                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('削除しますか？')">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach


            





        </tbody>
    </table>
@endsection
