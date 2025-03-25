<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class TaskController extends Controller
{
    public function index(Request $request)
    {


        $search = $request->input('search');
        if (auth()->user()->role === 'admin') {
            $tasks = Task::when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })->get();
        } else {
            $tasks = Task::when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })->where('worker_id', auth()->id())->get();
        }


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
            'title' => 'nullable|string',
            'description' => 'required|string',
            'duree_debut' => 'required|date_format:H:i',
            'duree_fin' => 'required|date_format:H:i|after:duree_debut',
            'status' => 'required|string',
            'project' => 'required|exists:projects,id',
            'worker_id' => 'required|exists:workers,id',
            'system_date' => 'nullable|date'
        ]);

        // Calculate duration in hours/minutes
        $start = Carbon::parse($validatedData['duree_debut']);
        $end = Carbon::parse($validatedData['duree_fin']);
        $duration = $end->diff($start);
        $hours = $duration->h + ($duration->i / 60);

        // Create task with calculated hours
        Task::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'duree_debut' => $validatedData['duree_debut'],
            'duree_fin' => $validatedData['duree_fin'],
            'hours' => round($hours, 2),
            'project_id' => $validatedData['project'],
            'worker_id' => $validatedData['worker_id'],
            'system_date' => $validatedData['system_date'] ?? now()
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task added successfully.');
    }



    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string',
            'description' => 'required|string',
            'duree_debut' => 'required|date_format:H:i',
            'duree_fin' => 'required|date_format:H:i|after:duree_debut',
            'status' => 'required|string',
            'project' => 'required|exists:projects,id',
            'system_date' => 'nullable|date'
        ]);

        // Calculate duration
        $start = Carbon::createFromFormat('H:i', $validatedData['duree_debut']);
        $end = Carbon::createFromFormat('H:i', $validatedData['duree_fin']);
        $hours = $end->diffInMinutes($start) / 60;

        $task->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'duree_debut' => $validatedData['duree_debut'],
            'duree_fin' => $validatedData['duree_fin'],
            'hours' => round($hours, 2),
            'project_id' => $validatedData['project'],
            'system_date' => $validatedData['system_date'] ?? $task->system_date
        ]);

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


    public function show($id)
    {
        $task = Task::with(['worker', 'project'])->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

}
