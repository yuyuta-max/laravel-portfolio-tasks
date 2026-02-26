<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            タスク詳細
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

            {{-- タイトル --}}
            <h3 class="text-2xl font-bold mb-4">
                {{ $task->title }}
                <span class="text-sm text-gray-500">by {{ $task->user->name }}</span>
            </h3>

            {{-- 説明 --}}
            <p class="mb-4">
                <strong>説明：</strong><br>
                {{ $task->description ?? '（なし）' }}
            </p>

            {{-- 期限 --}}
            <p class="mb-4">
                <strong>期限：</strong>
                {{ $task->due_date ?? '未設定' }}
            </p>

            {{-- 優先度 --}}
            <p class="mb-4">
                <strong>優先度：</strong>
                {{ $task->priority }}
            </p>

            {{-- 共有ユーザー --}}
            <p class="mb-4">
                <strong>共有ユーザー：</strong>
                @if($task->sharedUsers->isEmpty())
                    なし
                @else
                    {{ $task->sharedUsers->pluck('name')->join(', ') }}
                @endif
            </p>

            {{-- 戻る --}}
            <a href="{{ route('tasks.index') }}" class="text-blue-600 hover:underline">
                ← Back to task
            </a>

        </div>
    </div>
</x-app-layout>
