<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB; // Correct import statement

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tasksByMonth = Arr::get(
            Task::selectRaw('MONTH(system_date) as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('count', 'month')
                ->toArray(),
            null,
            []
        ); // Provide an empty array as the default

        $tasksByDay = Arr::get(
            Task::selectRaw('DAY(system_date) as day, COUNT(*) as count')
                ->groupBy('day')
                ->orderBy('day')
                ->get()
                ->pluck('count', 'day')
                ->toArray(),
            null,
            []
        ); // Provide an empty array as the default

        $tasksByYear = Arr::get(
            Task::selectRaw('YEAR(system_date) as year, COUNT(*) as count')
                ->groupBy('year')
                ->orderBy('year')
                ->get()
                ->pluck('count', 'year')
                ->toArray(),
            null,
            []
        ); // Provide an empty array as the default
        $search = $request->input('search');
        $projects = Project::when($search, function ($query, $search) {
            return $query->where('ref', 'like', '%' . $search . '%')
                ->orWhere('nom_projet', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        })->get();

        return view('projects.index', compact('projects', 'tasksByMonth', 'tasksByDay', 'tasksByYear'));
    }

    /**
     * Show the form for creating a new project.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'ref' => 'required|string|max:255|unique:projects',
            'nom_projet' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified project.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\View\View
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified project.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\View\View
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'ref' => 'required|string|max:255|unique:projects,ref,' . $project->id,
            'nom_projet' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }


    public function export()
{
    $projects = Project::all();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set header row
    $sheet->setCellValue('A1', 'Reference');
    $sheet->setCellValue('B1', 'Nom Projet');
    $sheet->setCellValue('C1', 'Description');

    // Populate data rows
    $row = 2; // Starting from row 2 since row 1 is header
    foreach ($projects as $project) {
        $sheet->setCellValue('A' . $row, $project->ref);
        $sheet->setCellValue('B' . $row, $project->nom_projet);
        $sheet->setCellValue('C' . $row, $project->description);
        $row++;
    }

    // Create writer and save file
    $writer = new Xlsx($spreadsheet);
    $filename = 'projects-' . date('Y-m-d-H-i-s') . '.xlsx';
    $writer->save($filename);

    // Return the file as a download
    return response()->download($filename, $filename)->deleteFileAfterSend();
}




public function getStatistics(Request $request, $id)
{
    $filter = $request->input('filter', 'month');

    $filterMap = [
        'month' => ['format' => '%Y-%m', 'column' => 'MONTH(system_date)'],
        'year' => ['format' => '%Y', 'column' => 'YEAR(system_date)'],
        'day' => ['format' => '%Y-%m-%d', 'column' => 'DATE(system_date)']
    ];

    if (!isset($filterMap[$filter])) {
        $filter = 'month';
    }

    if ($filter === 'day') {
        $filterMap['day']['column'] = 'DATE(system_date)';  // Use DATE for day
    }

    try {
        $query = Task::where('project_id', $id)
            ->select(
                'worker_id', // Use worker_id instead of user_id
                DB::raw("DATE_FORMAT(system_date, '{$filterMap[$filter]['format']}') as period"),  // Format the date
                DB::raw('SUM(hours) as total_hours')
            )
            ->groupBy('worker_id', 'period') // Group by both worker and period
            ->orderBy('period');

        $stats = $query->get();

        // Debugging: Log the raw SQL and bindings
        \Log::info('SQL Query:', ['query' => $query->toSql(), 'bindings' => $query->getBindings()]);

        $labels = $stats->map(function ($item) {
            return $item->worker->name . ' - ' . $item->period; // Access worker name
        })->toArray();
        $data = $stats->pluck('total_hours')->toArray();

        // Debugging: Log the labels and data
        \Log::info('Labels:', $labels);
        \Log::info('Data:', $data);

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    } catch (\Exception $e) {
        \Log::error($e->getMessage());
        return response()->json(['error' => 'Failed to load statistics', 'message' => $e->getMessage()], 500);
    }
}


public function getUserStatistics(Request $request, $id)
{
    $filter = $request->input('filter', 'month');

    $filterMap = [
        'month' => ['format' => '%Y-%m', 'column' => 'MONTH(system_date)'],
        'year' => ['format' => '%Y', 'column' => 'YEAR(system_date)'],
        'day' => ['format' => '%Y-%m-%d', 'column' => 'DATE(system_date)']
    ];

    if (!isset($filterMap[$filter])) {
        $filter = 'month';
    }

    if ($filter === 'day') {
        $filterMap['day']['column'] = 'DATE(system_date)';
    }

    try {
        $query = Task::where('project_id', $id)
            ->select(
                'worker_id',
                DB::raw("DATE_FORMAT(system_date, '{$filterMap[$filter]['format']}') as period"),
                DB::raw('SUM(hours) as total_hours')
            )
            ->groupBy('worker_id', 'period')
            ->orderBy('period');

        $stats = $query->get();

        $labels = $stats->map(function ($item) {
            return $item->worker->name . ' - ' . $item->period;
        })->toArray();
        $data = $stats->pluck('total_hours')->toArray();

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    } catch (\Exception $e) {
        \Log::error($e->getMessage());
        return response()->json(['error' => 'Failed to load statistics', 'message' => $e->getMessage()], 500);
    }
}




}
