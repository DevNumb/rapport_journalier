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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

    <style>
#calendarPopup {
    width: 100%;
    max-width: 800px;
}

#calendar {
    width: 100%;
    height: auto;
}

.fc-event-title {
    white-space: normal !important; /* Allow text to wrap */
    word-wrap: break-word; /* Break long words */
}
/* Ensure the modal appears on top of the calendar */

/* Ensure the modal appears on top of the calendar */
#projectDetailsModal {
    z-index: 9999; /* Higher than FullCalendar's z-index */
    position: fixed; /* Ensure it stays in place */
}

/* Optional: Ensure the modal backdrop appears on top */

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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWorkerModal">
    Add New User
</button>
<br> <br>
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

<div class="modal fade" id="projectDetailsModal" tabindex="-1" aria-labelledby="projectDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectDetailsModalLabel">Project Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Project Name:</strong> <span id="projectName"></span></p>
                <p><strong>project Name:</strong> <span id="projectDescription"></span></p>
                <p><strong>Start Date:</strong> <span id="projectStartDate"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Popup container -->
<div id="calendarPopup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.2); z-index: 9998;">
    <button id="closePopup" class="btn btn-secondary">Close</button>
    <div id="calendar" style="margin-top: 20px;"></div>
</div>


<!-- Modal for displaying project details -->


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
                        <button class="btn btn-success"><i class="fas fa-chart-bar"></i></button>
                        <button class="btn btn-primary openCalendar" data-worker-id="{{ $worker->id }}"><i class="fa fa-calendar"></i></button>

                            <button type="button" class="btn btn-sm btn-success editWorkerButton" data-worker-id="{{ $worker->id }}" data-worker-name="{{ $worker->name }}" data-worker-email="{{ $worker->email }}" data-worker-role="{{ $worker->role }}" data-worker-poste="{{ $worker->poste }}">Edit</button>
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


const $calendarPopup = $('#calendarPopup');
    const $closePopupButton = $('#closePopup');
    const $calendarEl = $('#calendar')[0]; // Get the DOM element
    let calendar;

    function initializeCalendar(workerId) {
    if (calendar) {
        calendar.destroy();
    }

    calendar = new FullCalendar.Calendar($calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth'
        },
        initialView: 'dayGridMonth',
        events: function (info, successCallback, failureCallback) {
            fetch(`/workers/${workerId}/tasks`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const events = data.map(task => {
                        return {
                            title: task.project_name, // Use full project name
                            start: new Date(task.system_date), // Parse the date string
                            end: new Date(task.system_date),
                            extendedProps: {
                                projectName: task.project_name, // Add project name
                                description: task.description || 'No description', // Add description
                                startDate: task.system_date // Add start date
                            }
                        };
                    });

                    successCallback(events);
                })
                .catch(error => {
                    console.error('Error fetching tasks:', error);
                    failureCallback(error);
                });
        },
        eventClick: function(info) {
            console.log('Event clicked:', info.event); // Debugging
            const projectName = info.event.extendedProps.projectName;
            const description = info.event.extendedProps.description;
            const startDate = info.event.extendedProps.startDate;

            document.getElementById('projectName').textContent = projectName;
            document.getElementById('projectDescription').textContent = description;
            document.getElementById('projectStartDate').textContent = startDate;

            const projectDetailsModal = new bootstrap.Modal(document.getElementById('projectDetailsModal'));
            projectDetailsModal.show();
        },
        height: 'auto',
    });

    calendar.render();
}
    // Open Calendar Popup Handler
    $(document).on('click', '.openCalendar', function() {
            const workerId = $(this).data('worker-id');
            console.log(workerId);
            initializeCalendar(workerId);
            $calendarPopup.show();
        });


    // Close Calendar Popup Handler
    $closePopupButton.on('click', function () {
        $calendarPopup.css('display', 'none');
    });
</script>

</body>

                </tbody>
            </table>

        </div>
    </div>
</div>



<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
