@extends('layouts.app')

@section('content')

    <h1>Projects</h1>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('projects.create') }}" class="btn btn-primary">Create Project</a> <a href="{{ route('projects.export') }}" class="btn btn-success">
    Export to Excel
</a>

<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#statisticsModal" title="Show Statistics">Show Statstique</a>


  <br> <br>

  

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('projects.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search projects..." value="{{ request()->input('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                    @if(request()->input('search'))
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Clear Search</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        // Function to create a chart
        function createChart(canvasId, chartType, labels, data, labelText, borderColor, backgroundColor) {
            var canvas = document.getElementById(canvasId).getContext('2d');
            new Chart(canvas, {
                type: chartType,
                data: {
                    labels: labels,
                    datasets: [{
                        label: labelText,
                        data: data,
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }

        // Monthly Chart Data
        var monthlyLabels = <?php echo json_encode(array_keys($tasksByMonth)); ?>;
        var monthlyData = <?php echo json_encode(array_values($tasksByMonth)); ?>;
        createChart('monthlyChart', 'bar', monthlyLabels, monthlyData, 'Tasks by Month', 'rgba(75, 192, 192, 1)', 'rgba(75, 192, 192, 0.2)');

        // Daily Chart Data
        var dailyLabels = <?php echo json_encode(array_keys($tasksByDay)); ?>;
        var dailyData = <?php echo json_encode(array_values($tasksByDay)); ?>;
        createChart('dailyChart', 'bar', dailyLabels, dailyData, 'Tasks by Day', 'rgba(255, 99, 132, 1)', 'rgba(255, 99, 132, 0.2)');

        // Yearly Chart Data
        var yearlyLabels = <?php echo json_encode(array_keys($tasksByYear)); ?>;
        var yearlyData = <?php echo json_encode(array_values($tasksByYear)); ?>;
        createChart('yearlyChart', 'bar', yearlyLabels, yearlyData, 'Tasks by Year', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 0.2)');
    });
</script>



    <!-- Statistics Modal -->
<div class="modal fade" id="statisticsModal" tabindex="-1" aria-labelledby="statisticsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statisticsModalLabel">Task Statistics</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6>Tasks by Month</h6>
                        <canvas id="monthlyChart" width="100%" height="100%"></canvas>
                    </div>
                    <div class="col-md-4">
                        <h6>Tasks by Day</h6>
                        <canvas id="dailyChart" width="100%" height="100%"></canvas>
                    </div>
                    <div class="col-md-4">
                        <h6>Tasks by Year</h6>
                        <canvas id="yearlyChart" width="100%" height="100%"></canvas>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <table class="table">
        <thead>
            <tr>
                <th>Ref</th>
                <th>Nom Projet</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{ $project->ref }}</td>
                    <td>{{ $project->nom_projet }}</td>
                    <td>{{ $project->description }}</td>
                    <td>
                  
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-info">View</a>
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">Edit</a>
                       

                  
    <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-2">Delete</button>
    </form>
   <!-- Statistics Button -->
   <button 
        type="button" 
        class="btn btn-success mt-2 open-statistics-modal" 
        data-bs-toggle="modal" 
        data-bs-target="#statisticsModal1"
        data-project-id="{{ $project->id }}"
        data-project-name="{{ $project->nom_projet }}">
    <i class="fas fa-chart-bar"></i>
</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
 <!-- Modal -->
<div class="modal fade" id="statisticsModal1" tabindex="-1" aria-labelledby="statisticsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statisticsModalLabel"></h5> <!-- To update modal title -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                    <h1 id="project-name-display"></h1>  <!-- Display project name here -->
                        <select class="form-select" id="timeFilter">
                            <option value="month">By Month</option>
                            <option value="day">By Day</option>
                            <option value="year">By Year</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="projectChart" width="100%" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.open-statistics-modal');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const projectId = this.getAttribute('data-project-id');
            const projectName = this.getAttribute('data-project-name');
            const modalTitle = document.getElementById('statisticsModalLabel');
            const projectNameDisplay = document.getElementById('project-name-display');  // Correct ID

            modalTitle.textContent = `${projectName} Statistics`;
            projectNameDisplay.textContent = projectName;  // Set text content
           
            fetchStatistics(projectId);
        });
    });

    document.getElementById('timeFilter').addEventListener('change', function() {
        const projectId = document.querySelector('.open-statistics-modal[data-bs-target="#statisticsModal1"]').getAttribute('data-project-id');
        fetchStatistics(projectId);
    });

    function fetchStatistics(projectId) {
        const timeFilter = document.getElementById('timeFilter').value;
        const url = `/projects/${projectId}/statistics?filter=${timeFilter}`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Received data:', data); //Debugging
                updateChart(data.labels, data.data);
            })
            .catch(error => {
                console.error('Error fetching statistics:', error);
                alert('Failed to load statistics. Check the console for details.');
            });
    }

    function updateChart(labels, data) {
        const ctx = document.getElementById('projectChart').getContext('2d');
        if (window.myChart) {
            window.myChart.destroy();
        }

        window.myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Hours',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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



</script>
@endsection
