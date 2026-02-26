<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left -->
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('tasks.index') }}" class="font-bold text-lg">
                        TaskApp
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')">
                        タスク一覧
                    </x-nav-link>

                    <x-nav-link :href="route('tasks.create')" :active="request()->routeIs('tasks.create')">
                        タスク作成
                    </x-nav-link>

                </div>
            </div>

            <!-- Right -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Logout
                    </button>
                </form>


            </div>

        </div>
    </div>
</nav>
