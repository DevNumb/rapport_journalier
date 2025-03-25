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
    overflow: hidden; /* Prevent content from spilling out */
}

#calendar {
    width: 100%;
    height: auto;
    max-height: 500px; /* Optional: Add scroll if content grows */
    overflow-y: auto;
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

.custom-title {
    font-size: 28px; /* Adjust font size */
    font-weight: bold;
    text-align: center;/* Make the text bold */
}

/* Optional: Ensure the modal backdrop appears on top */

    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <!-- Brand/Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            Rapport Journalier
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    @if(auth()->user()->role === 'admin')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('workers.index') ? 'active' : '' }}" href="{{ route('workers.index') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('calendar.index') ? 'active' : '' }}" href="{{ route('calendar.index') }}">Calendar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('activities.index') ? 'active' : '' }}" href="{{ route('activities.index') }}">Manage Activities</a>
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
            <a class="nav-link {{ request()->routeIs('activity-logs.index') ? 'active' : '' }}" href="{{ route('activity-logs.index') }}">Activity Logs</a>
        </li>
    @elseif(auth()->user()->role === 'worker')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('calendar.index') ? 'active' : '' }}" href="{{ route('calendar.index') }}">Calendar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('tasks.index') ? 'active' : '' }}" href="{{ route('tasks.index') }}">Manage Tasks</a>
        </li>
    @endif
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
        <!-- Page Heading --><br><br>
        <h1 class="h3 mb-4 text-gray-800 custom-title">Dashboard</h1><br>
        @if(auth()->user()->role === 'admin')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWorkerModal">
    Add New User
</button>
@endif
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
                @if(auth()->user()->role === 'admin')
                        <button class="btn btn-success openStatsModal" data-worker-id="{{ $worker->id }}">
    <i class="fas fa-chart-bar"></i>
</button>

                        <button class="btn btn-primary openCalendar" data-worker-id="{{ $worker->id }}"><i class="fa fa-calendar"></i></button>

                            <button type="button" class="btn btn-sm btn-success editWorkerButton" data-worker-id="{{ $worker->id }}" data-worker-name="{{ $worker->name }}" data-worker-email="{{ $worker->email }}" data-worker-role="{{ $worker->role }}" data-worker-poste="{{ $worker->poste }}">Edit</button>
                            <form action="{{ route('workers.destroy', $worker->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                @endif
                        </td>
                    </tr>
                @endforeach
<!-- resources/views/modals/worker_stats.blade.php -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Your custom script should come AFTER Chart.js -->


<div class="modal fade" id="workerStatsModal" tabindex="-1" aria-labelledby="workerStatsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="workerStatsModalLabel">Worker Statistics</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    <select id="statsTypeSelect" class="form-select">
        <option value="month">Month</option>
        <option value="year">Year</option>
        <option value="day">Day</option>
    </select>
    <div id="statsContent"></div>
    <canvas id="statsChart"></canvas>
</div>
        </div>
    </div>
</div>






<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
let myChart;

$(document).ready(function() {
    $(document).on('click', '.openStatsModal', function() {
        var workerId = $(this).data('worker-id');
        $('#workerStatsModal').data('worker-id', workerId); // Set data on the modal
        loadStats(workerId, 'month'); // Load default month stats
    });

    $('#statsTypeSelect').on('change', function() {
        var workerId = $('#workerStatsModal').data('worker-id'); // Get workerId from modal
        var statsType = $(this).val();
        loadStats(workerId, statsType);
    });

    function loadStats(workerId, statsType) {
        $.ajax({
            type: 'GET',
            url: '/worker/stats/' + workerId + '/' + statsType,
            success: function(data) {
                //Clear error content before populating data
                 $('#statsContent').empty();

                if (myChart) {
                    myChart.destroy();
                }

                var tableHtml = '<table class="table table-bordered">';
                tableHtml += '<thead><tr><th>Project Names</th><th>Period</th><th>Total Hours Worked</th></tr></thead>';
                tableHtml += '<tbody>';

                var chartLabels = [];
                var chartData = [];

                if (data.length === 0) {
                    $('#statsContent').html("No projects worked");
                    return; // No data exist
                }

                if (Array.isArray(data)) {
                    data.forEach(function(stat) {
                        tableHtml += `<tr><td>${stat.project_names.join(', ')}</td><td>${stat.period}</td><td>${stat.total_hours}</td></tr>`;
                        chartLabels.push(stat.period);
                        chartData.push(stat.total_hours);
                    });
                } else {
                    $('#statsContent').html("<p>Error: Data is an empty array</p>");
                    return;
                }

                tableHtml += '</tbody></table>';
                $('#statsContent').html(tableHtml);
                createChart(chartLabels, chartData);
                $('#workerStatsModal').modal('show');

            },
            error: function(xhr) {
                console.error('Error fetching worker stats:', xhr.responseText);
                $('#statsContent').html("<p>Error loading stats.  Check the console.</p>");
            }
        });
    }

    function createChart(labels, hoursWorked) {
        var ctx = document.getElementById('statsChart').getContext('2d');
        myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Hours Worked',
                    data: hoursWorked,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});








</script>              <!-- Scripts -->
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
