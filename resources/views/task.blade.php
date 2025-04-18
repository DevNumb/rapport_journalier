<!-- resources/views/tasks/index.blade.php -->
@extends('layouts.app')

@section('title', 'Mon journaliers')

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

                    <div class="mb-3">
                        <label for="project" class="form-label">Project</label>
                        <select name="project" id="editProject" class="form-control" required>
                        <option value="">Select a Project</option>
                         @foreach($projects->sortBy('nom_projet') as $project)
                        <option value="{{ $project->id }}">{{ $project->ref }}</option>
    @endforeach
</select>
                    </div>
                        <label for="title" class="form-label">Titre de tache </label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description de tache </label>
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
                        <label for="duree_debut" class="form-label">Start Time</label>
                        <input type="time"
                               name="duree_debut"
                               id="duree_debut"
                               class="form-control"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="duree_fin" class="form-label">End Time</label>
                        <input type="time"
                               name="duree_fin"
                               id="duree_fin"
                               class="form-control"
                               required>
                    </div>
                    <input type="hidden" name="worker_id" value="{{ Auth::id() }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






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
                    <input type="hidden" name="worker_id" value="{{ Auth::id() }}">
                    <div class="mb-3">
                        <label for="editProject" class="form-label">Project</label>
                        <select name="project" id="editProject" class="form-control" required>
                        <option value="">Select a Project</option>
                         @foreach($projects->sortBy('nom_projet') as $project)
                        <option value="{{ $project->id }}">{{ $project->nom_projet }}</option>
    @endforeach
</select>

                    </div>
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">titre de tache</label>
                        <input type="text" name="title" id="editTitle" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description de tache</label>
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
                        <label for="editDureeDebut" class="form-label">Start Time</label>
                        <input type="time" name="duree_debut" id="editDureeDebut" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="editDureeFin" class="form-label">End Time</label>
                        <input type="time" name="duree_fin" id="editDureeFin" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="editSystemDate" class="form-label">System Date</label>
                        <input type="date" name="system_date" id="editSystemDate" class="form-control">
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



<!-- Blade Template -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Liste des tâches</h4>
                </div>
                <div class="card-body">
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
                                    <td>{{ $task->system_date->format('Y-m-d H:i:s') }}</td>

                                    <td>
                                        @php
                                            $taskDate = \Carbon\Carbon::parse($task->system_date);
                                            $isEditable = $taskDate->isToday();
                                        @endphp

                                        <button type="button"
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
                                            Modifier
                                        </button>

                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination with Information-->
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} results
                        </div>
                        <nav aria-label="Task pagination">
                            <ul class="pagination pagination-sm justify-content-end">  <!-- Use pagination-sm -->
                                <li class="page-item {{ $tasks->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $tasks->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                @foreach ($tasks->getUrlRange(max($tasks->currentPage() - 2, 1), min($tasks->currentPage() + 2, $tasks->lastPage())) as $page => $url)
                                    <li class="page-item {{ $tasks->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item {{ $tasks->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $tasks->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







    </div>

    <footer class="text-center mt-5 py-4" style="background: linear-gradient(45deg, #343a40, #495057); color: #f8f9fa; font-family: 'Inter', sans-serif;">
    <p style="margin: 0; font-size: 1.2rem;">&copy; All rights reserved 2025  GEREP Environnement</p>
    <div style="margin-top: 10px;">
        <a href="#" style="color: #f8f9fa; margin: 0 10px; text-decoration: none;">Privacy Policy</a>
        <a href="#" style="color: #f8f9fa; margin: 0 10px; text-decoration: none;">Terms of Service</a>
        <a href="#" style="color: #f8f9fa; margin: 0 10px; text-decoration: none;">Contact Us</a>
    </div>
    <div style="margin-top: 15px;">
        <a href="#" style="color: #f8f9fa; margin: 0 5px;"><i class="fab fa-facebook"></i></a>
        <a href="#" style="color: #f8f9fa; margin: 0 5px;"><i class="fab fa-twitter"></i></a>
        <a href="#" style="color: #f8f9fa; margin: 0 5px;"><i class="fab fa-instagram"></i></a>
    </div>
</footer>

</body>
</html>
@endsection
