<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() // Remove the unnecessary argument
    {
        // Fetch all workers from the database
        $workers = Worker::all();

        // Pass the workers to the view
        return view('dashboard', compact('workers'));
    }

    public function edit($id)
{
    $worker = Worker::findOrFail($id);
    return view('workers.edit', compact('worker'));
}

}
