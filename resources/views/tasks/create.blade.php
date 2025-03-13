<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>
</head>
<body>
    <h1>Create Task</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="to do">to do</option>
            <option value="in progress">in Progress</option>
            <option value="done">done</option>
        </select>
        <br>
        <button type="submit">Create</button>
    </form>
</body>
</html>