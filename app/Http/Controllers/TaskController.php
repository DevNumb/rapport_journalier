<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::with('project')->get();
        $search = $request->input('search');
        $tasks = Task::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        })->get();
    
        $projects = Project::all(); // Fetch all projects
    
        return view('task', compact('tasks', 'projects')); // Pass $projects to the view
    }
    


    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'project' => 'nullable|exists:projects,id',
            'hours' => 'nullable|numeric', // Ensure project ID exists in the projects table
        ]);


        // Manually map the project field to project_id
        $task = new Task();
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->status = $validatedData['status'];
        $task->project_id = $validatedData['project'];
        $task->worker_id = Auth::id();
        $task->hours = $validatedData['hours'];// Assign project ID here
        $task->save();
    
        return redirect()->route('tasks.index')->with('success', 'Task added successfully.');
    }
    
    
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'project' => 'nullable|string', // Validate project_id
        ]);
    
        $task->update($validatedData);
    
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
    
    


    public function edit(Task $task)
    {
        $projects = Project::all();  // Retrieve all projects
        return response()->json(['task' => $task, 'projects' => $projects]);
    }
    



    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }


    public function export()
    {
        $tasks = Task::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header row
        $sheet->setCellValue('A1', 'Title');
        $sheet->setCellValue('B1', 'Description');
        $sheet->setCellValue('C1', 'Status');

        // Populate data rows
        $row = 2; // Starting from row 2 since row 1 is header
        foreach ($tasks as $task) {
            $sheet->setCellValue('A' . $row, $task->title);
            $sheet->setCellValue('B' . $row, $task->description);
            $sheet->setCellValue('C' . $row, $task->status);
            $row++;
        }

        // Create writer and save file
        $writer = new Xlsx($spreadsheet);
        $filename = 'tasks-' . date('Y-m-d-H-i-s') . '.xlsx';
        $writer->save($filename);

        // Return the file as a download
        return response()->download($filename, $filename)->deleteFileAfterSend();
    }

}
