<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Create Task</h1>
        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label for="title" class="block text-gray-600 font-medium">Title:</label>
                <input type="text" id="title" name="title" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300 focus:outline-none">
            </div>

            <div>
                <label for="description" class="block text-gray-600 font-medium">Description:</label>
                <textarea id="description" name="description" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300 focus:outline-none"></textarea>
            </div>

            <div>
                <label for="status" class="block text-gray-600 font-medium">Status:</label>
                <select id="status" name="status" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300 focus:outline-none">
                    <option value="to do">To Do</option>
                    <option value="in progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                Create Task
            </button>
        </form>
    </div>
</body>
</html>
