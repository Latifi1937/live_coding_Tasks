<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl">
        <h1 class="text-2xl font-bold text-center mb-4">Tasks</h1>
        
        <div class="text-right mb-4">
            <a href="{{ route('tasks.create') }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                + Create New Task
            </a>
        </div>

        <ul class="space-y-4">
            @foreach ($tasks as $task)
                <li class="p-4 bg-gray-50 rounded-md shadow flex justify-between items-center">
                    <div>
                        <p class="font-semibold">{{ $task->title }}</p>
                        <p class="text-gray-600 text-sm">{{ $task->description }}</p>
                        <p class="text-xs text-gray-500">Status: <span class="font-medium">{{ ucfirst($task->status) }}</span></p>
                    </div>
                    
                    <div class="space-x-2">
                        <a href="{{ route('tasks.edit', $task->id) }}" 
                           class="bg-green-500 text-white px-3 py-1 rounded-md text-sm hover:bg-green-600 transition">
                            Edit
                        </a>
                        
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

</body>
</html>
