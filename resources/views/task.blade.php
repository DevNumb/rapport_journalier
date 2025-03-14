<!-- resources/views/tasks/index.blade.php -->
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tasks</title>

     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        /* Your custom CSS here */
    </style>
    
</head>
<body>

    <div class="container">
        <h1>Manage Tasks</h1>


   

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTaskModal">
            Create New Task
        </button>     
         <a href="{{ route('tasks.export') }}" class="btn btn-success">
    Export to Excel
</a>
   <br> <br>
   <div class="row">
            <div class="col-md-12">
                <form action="{{ route('tasks.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Search tasks..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                        @if(request()->input('search'))
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Clear Search</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
</div>
   <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskModalLabel">Create New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="createTaskForm" action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control" required>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="project" class="form-label">Project</label>
        <select name="project" id="project" class="form-control">
            <option value="">Select a Project</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->nom_projet }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="hours" class="form-label">Hours</label>
        <input type="number" step="any" name="hours" id="hours" class="form-control" required>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

            </div>
        </div>
    </div>
</div>


 <!-- resources/views/tasks/index.blade.php -->

<!-- Edit Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTaskForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editTaskId" name="task_id">

                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Title</label>
                        <input type="text" name="title" id="editTitle" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea name="description" id="editDescription" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select name="status" id="editStatus" class="form-control" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editProject" class="form-label">Project</label>
                        <select name="project" id="editProject" class="form-control">
                            <option value="">Select a Project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->nom_projet }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editHours" class="form-label">Hours</label>
                        <input type="number" step="any" name="hours" id="editHours" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('.editTaskButton').click(function() {
            var taskId = $(this).data('task-id');
            var taskTitle = $(this).data('task-title');
            var taskDescription = $(this).data('task-description');
            var taskStatus = $(this).data('task-status');
            var taskProject = $(this).data('task-project');
            var taskHours = $(this).data('task-hours');

            $('#editTaskId').val(taskId);
            $('#editTitle').val(taskTitle);
            $('#editDescription').val(taskDescription);
            $('#editStatus').val(taskStatus);
            $('#editProject').val(taskProject);
            $('#editHours').val(taskHours);

            // Set the form's action URL with the task ID
            $('#editTaskForm').attr('action', '/tasks/' + taskId);

            // Show the modal
            $('#editTaskModal').modal('show');
        });
    });
</script>

       
  

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->system_date->format('Y-m-d H:i:s') }}</td> <!-- Display system_date -->
                
                <td>
                @php
        $taskDate = \Carbon\Carbon::parse($task->system_date);
        $isEditable = $taskDate->isToday();
    @endphp
                    <button     type="button"
        class="btn btn-sm btn-primary editTaskButton"
        data-bs-toggle="modal"
        data-bs-target="#editTaskModal"
        data-task-id="{{ $task->id }}"
        data-task-title="{{ $task->title }}"
        data-task-description="{{ $task->description }}"
        data-task-status="{{ $task->status }}"
        data-task-project="{{ $task->project_id }}"
        data-task-hours="{{ $task->hours }}"
        {{ $isEditable ? '' : 'disabled' }}>
        Edit</button>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


  

    </div>

  
</body>
</html>
@endsection