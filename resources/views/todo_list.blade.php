<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>Todo List</title>
</head>

<body class="bg-gray-600">

    <div class="w-2/5 mx-auto rounded bg-gray-100 bg-opacity-75 mt-20 p-8">
        <h1 class="text-xl font-semibold">Todo List</h1>

        <!-- add new task -->
        <form action="{{ route('tasks.store') }}" method="post">
            @csrf
            <div class="flex justify-between py-4">
                <input name="body" class="border-2 p-1 w-full @error('body') border-red-400 @enderror" type="text">
                <button class="bg-gray-600 hover:bg-gray-500 text-white font-bold py-1 px-4 rounded">Add</button>
            </div>
        </form>

        <div class="overflow-auto h-64">
            @if($tasks->count())
            <!-- display all tasks -->
            @foreach($tasks as $task)
            <div class="flex justify-between py-1">

                <!-- check/uncheck task if complete/incomplete -->
                <form action="{{ route('tasks.update', $task) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button class="focus:outline-none text-gray-800">
                        @if($task->completed === 0)
                        <i class="far fa-square fa-lg"></i>
                        @else
                        <i class="fas fa-check-square fa-lg"></i>
                        @endif
                    </button>
                    <label class="text-lg px-4
                                @if($task->completed === 1) 
                                    text-gray-400 line-through 
                                @endif">{{ ucfirst($task->body) }}
                    </label>
                </form>

                <!-- delete a task -->
                <form action="{{ route('tasks.destroy', $task) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="focus:outline-none text-gray-800">
                        <i class="far fa-trash-alt fa-lg"></i>
                    </button>
                </form>
            </div>
            @endforeach
            @else
            <label class="text-lg">You dont have any task!</label>
            @endif
        </div>
    </div>
</body>

</html>