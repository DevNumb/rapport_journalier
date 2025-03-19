<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Task;

class WorkerController extends Controller
{
    // Display a listing of the workers
    public function index()
    {
        $user = auth()->user();
        $workers = Worker::all();
        if ($user->role === 'admin') {
            // Fetch data for admin dashboard
            $data = [
                // Add admin-specific data here
                'workers' => Worker::all(),
                // etc.
            ];
        } elseif ($user->role === 'worker') {
            // Fetch data for worker dashboard
            $data = [
                // Add worker-specific data here
                $tasks = Task::where('worker_id', $user->id)->get(),

                // etc.
            ];
        }


        return view('dashboard', compact('data','workers'));
    }


    // Show the form for creating a new worker
    public function create()
    {
        return view('workers.create');
    }

    public function show($id)
    {
        // Fetch the worker by ID
        $worker = Worker::find($id);

        // Pass the $worker variable to the view
    }

    // Store a newly created worker in the database
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:workers,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:worker,admin',
            'poste' => 'required|string|max:255', // Add validation for poste

        ]);

        // Create the worker
        Worker::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'role' => $request->role,
            'poste' => $request->poste, // Use consistent field name
        ]);

        // Return a JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Worker added successfully!',
            ]);
        }

        // Redirect for non-AJAX requests
        return redirect()->route('workers.index')->with('success', 'Worker added successfully.');
    }

    // Display the specified worker

    public function edit($id)
    {
        $worker = Worker::find($id);
        return view('workers.edit', ['workers' => $workers]); // Using an associative array
    }

    // Update the specified worker in the database
    public function update(Request $request, Worker $worker)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:workers,email,' . $worker->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:worker,admin',
            'poste' => 'required|string|max:255', // Add validation for poste
        ]);

        // Update the worker
        $worker->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $worker->password, // Update password only if provided
            'role' => $request->role,
            'poste' => $request->poste, // Add validation for poste
        ]);

        // Redirect with a success message
        return redirect()->route('workers.index')->with('success', 'Worker updated successfully.');
    }

    public function destroy($id)
    {
        // Find the worker by ID
        $worker = Worker::find($id);

        // Check if the worker exists
        if (!$worker) {
            return redirect()->route('workers.index')->with('error', 'Worker not found.');
        }

        // Delete the worker
        $worker->delete();

        // Redirect with a success message
        return redirect()->route('workers.index')->with('success', 'Worker deleted successfully.');
    }
    public function getTasksByWorker($worker_id)
{
    Log::info("Fetching tasks for worker ID: " . $worker_id); // Log worker ID

    $tasks = Task::where('worker_id', $worker_id)->with('project')->get();

    Log::info("Retrieved tasks: ", $tasks->toArray()); // Log the tasks retrieved

    // Debugging: Log each task and its project
    foreach ($tasks as $task) {
        Log::info("Task ID: " . $task->id . ", Project: " . ($task->project ? $task->project->nom_projet : 'No Project'));
    }

    $tasksWithProjectNames = $tasks->map(function ($task) {
        return [
            'system_date' => $task->system_date ? $task->system_date->format('Y-m-d') : null,
            'project_name' => $task->project ? $task->project->nom_projet : 'No Project',
        ];
    });

    return response()->json($tasksWithProjectNames);
}

public function getWorkerStats($worker_id, $statsType = 'month')
{
    $tasks = Task::where('worker_id', $worker_id)->with('project')->get();

    $groupedStats = [];

    switch ($statsType) {
        case 'month':
            $groupedStats = $tasks->groupBy(function ($task) {
                return $task->system_date->format('Y-m');
            })->map(function ($group) {
                return [
                    'period' => $group->first()->system_date->format('Y-m'),
                    'total_hours' => $group->sum('hours'),
                    'project_names' => $group->map(function ($task) {
                        return $task->project ? $task->project->nom_projet : 'No Project';
                    })->unique()->values()->all(), // Get unique project names
                ];
            })->values()->toArray();
            break;
        case 'year':
            $groupedStats = $tasks->groupBy(function ($task) {
                return $task->system_date->format('Y');
            })->map(function ($group) {
                return [
                    'period' => $group->first()->system_date->format('Y'),
                    'total_hours' => $group->sum('hours'),
                    'project_names' => $group->map(function ($task) {
                        return $task->project ? $task->project->nom_projet : 'No Project';
                    })->unique()->values()->all(), // Get unique project names
                ];
            })->values()->toArray();
            break;
        case 'day':
            $groupedStats = $tasks->groupBy(function ($task) {
                return $task->system_date->format('Y-m-d');
            })->map(function ($group) {
                return [
                    'period' => $group->first()->system_date->format('Y-m-d'),
                    'total_hours' => $group->sum('hours'),
                    'project_names' => $group->map(function ($task) {
                        return $task->project ? $task->project->nom_projet : 'No Project';
                    })->unique()->values()->all(), // Get unique project names
                ];
            })->values()->toArray();
            break;
        default:
            return response()->json(['error' => 'Invalid statsType'], 400);
    }

    if (empty($groupedStats)) {
        \Log::info("No data found for worker_id: $worker_id, statsType: $statsType");
    }

    return response()->json($groupedStats);
}








}
