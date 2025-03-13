<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $task->title }}" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required>{{ $task->description }}</textarea>
        <br>
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="to do" {{ $task->status == 'to do' ? 'selected' : '' }}>To Do</option>
            <option value="in progress" {{ $task->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
            <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
        </select>        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>