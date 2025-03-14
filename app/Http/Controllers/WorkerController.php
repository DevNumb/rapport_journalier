<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkerController extends Controller
{
    // Display a listing of the workers
    public function index()
    {
        $workers = Worker::all(); // Fetch all workers
        return view('dashboard', compact('workers'));
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

    // Remove the specified worker from the database
    public function destroy(Worker $worker)
    {
        $worker->delete();
        return redirect()->route('workers.index')->with('success', 'Worker deleted successfully.');
    }
}
