<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            タスク一覧
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('tasks.create') }}"
                class="bg-green-700 text-white font-bold px-4 py-4 rounded-md shadow-md hover:bg-blue-300 transition">
                ＋ 新規タスク
            </a>

            <div class="mt-6 bg-white shadow-sm rounded-lg p-6">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="py-2 px-4 text-left w-20">完了</th>
                            <th class="py-2 px-4 text-center">タイトル</th>
                            <th class="py-2 px-4 text-left w-40">期限</th>
                            <th class="px-4 text-left w-32">操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>
                                    <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="checkbox" onChange="this.form.submit()"
                                            {{ $task->is_done ? 'checked' : '' }}>
                                    </form>
                                </td>

                                <td class="{{ $task->is_done ? 'line-through text-gray-400' : '' }}"
                                    style="background-color: {{ $task->priorityColor() }};">
                                    <a href="{{ route('tasks.show', $task) }}" class="font-bold hover:underline">
                                        {{ $task->title }}
                                    </a>
                                    <span class="text-sm text-gray-600">by {{ $task->user->name }}</span>
                                </td>




                                <td>{{ $task->due_date }}</td>

                                <td>
                                    <a href="{{ route('tasks.edit', $task) }}"
                                        class="text-yellow-500 hover:underline">編集</a>

                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:underline"
                                            onclick="return confirm('削除しますか？')">
                                            削除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</x-app-layout>
