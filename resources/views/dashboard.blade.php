<!-- resources/views/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>

    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <!-- Brand/Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('path/to/your/logo.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
            Rapport Journal
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('workers.index') ? 'active' : '' }}" href="{{ route('workers.index') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('calendar.index') }}">Calendar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('activities.index') }}">Manage Activities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tasks.index') ? 'active' : '' }}" href="{{ route('tasks.index') }}">Manage Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('reports.index') ? 'active' : '' }}" href="{{ route('reports.index') }}">Manage Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('projects.index') ? 'active' : '' }}" href="{{ route('projects.index') }}">Manage Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('journaliers.index') ? 'active' : '' }}" href="{{ route('journaliers.index') }}">Journalier Entries</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('activity-logs.index') }}">Activity Logs</a>
                </li>
            </ul>

            <!-- User Dropdown -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <li>
                            <hr class="dropdown-divider">
                        </li>
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


<div class="main-content">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

        <!-- Workers Table -->
        <div class="table-responsive">
            <!-- Add Worker Modal -->
            <div class="modal fade" id="addWorkerModal" tabindex="-1" aria-labelledby="addWorkerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addWorkerModalLabel">Add New Worker</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addWorkerForm" action="{{ route('workers.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" id="role" class="form-control" required>
                                        <option value="worker">Worker</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="poste" class="form-label">Poste</label>
                                    <input type="text" name="poste" id="poste" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Worker</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Worker Modal -->
<div class="modal fade" id="editWorkerModal" tabindex="-1" aria-labelledby="editWorkerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editWorkerModalLabel">Edit Worker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editWorkerForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" name="email" id="editEmail" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPassword" class="form-label">Password</label>
                        <input type="password" name="password" id="editPassword" class="form-control">
                        <small class="text-muted">Leave blank if you don't want to change the password.</small>
                    </div>
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role</label>
                        <select name="role" id="editRole" class="form-control" required>
                            <option value="worker">Worker</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editPoste" class="form-label">Poste</label>
                        <input type="text" name="poste" id="editPoste" class="form-control" required>
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

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Poste</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($workers as $worker)
                    <tr>
                        <td>{{ $worker->id }}</td>
                        <td>{{ $worker->name }}</td>
                        <td>{{ $worker->email }}</td>
                        <td>{{ $worker->role }}</td>
                        <td>{{ $worker->poste }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary editWorkerButton" data-worker-id="{{ $worker->id }}" data-worker-name="{{ $worker->name }}" data-worker-email="{{ $worker->email }}" data-worker-role="{{ $worker->role }}" data-worker-poste="{{ $worker->poste }}">Edit</button>
                            <form action="{{ route('workers.destroy', $worker->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <!-- Scripts -->
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('.editWorkerButton').click(function() {
            var workerId = $(this).data('worker-id');
            var workerName = $(this).data('worker-name');
            var workerEmail = $(this).data('worker-email');
            var workerRole = $(this).data('worker-role');
            var workerPoste = $(this).data('worker-poste');

            $('#editName').val(workerName);
            $('#editEmail').val(workerEmail);
            $('#editRole').val(workerRole);
            $('#editPoste').val(workerPoste);

            // Set the form's action URL with the worker ID
            $('#editWorkerForm').attr('action', '/workers/' + workerId);

            // Show the modal
            $('#editWorkerModal').modal('show');
        });
    });
</script>

</body>

                </tbody>
            </table>

        </div>
    </div>
</div>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addWorkerModal">
    <i class="bi bi-plus"></i> Add New Worker
</button>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
