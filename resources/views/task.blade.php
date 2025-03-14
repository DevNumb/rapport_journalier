<!-- resources/views/tasks/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tasks</title>

     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        /* Your custom CSS here */
    </style>
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

    <div class="container-fluid">
        <!-- Brand/Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('path/to/your/logo.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
            rapport_journail
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('workers.index') ? 'active' : '' }}" href="{{ route('workers.index') }}">Manage Workers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tasks.index') ? 'active' : '' }}" href="{{ route('tasks.index') }}">Manage Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
                </li>
                <li class="nav-item">
    <a class="nav-link" href="{{ route('calendar.index') }}">Calendar</a>
</li>

            </ul>

            <!-- User Dropdown -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2">{{ auth()->user()->name }}</span>
                        <i class="fas fa-user-circle fa-lg"></i> <!-- Font Awesome user icon -->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cog me-2"></i> Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
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
