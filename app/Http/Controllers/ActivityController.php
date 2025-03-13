<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Exports\ActivitiesExport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ActivityController extends Controller
{
    /**
     * Display a listing of the activities.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $activities = Activity::when($search, function ($query, $search) {
        $query->where('nom_projet', 'LIKE', "%$search%")
              ->orWhere('description', 'LIKE', "%$search%");
    })->paginate(10);

    return view('activities.index', compact('activities'));
}


    /**
     * Show the form for creating a new activity.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created activity in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_projet' => 'required|string|max:255',
            'duree_debut' => 'required|date',
            'duree_fin' => 'required|date',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        Activity::create($request->all());

        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }

    /**
     * Display the specified activity.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\View\View
     */
    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified activity.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\View\View
     */
    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified activity in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'nom_projet' => 'required|string|max:255',
            'duree_debut' => 'required|date', // Change to 'date' for datetime-local
            'duree_fin' => 'required|date',   // Change to 'date' for datetime-local
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $activity->update($request->all());

        return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
    }

    /**
     * Remove the specified activity from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header row
        $sheet->setCellValue('A1', 'Nom_Projet');
        $sheet->setCellValue('B1', 'Duree_Debut');
        $sheet->setCellValue('C1', 'Duree_Fin');
        $sheet->setCellValue('D1', 'Description');
        $sheet->setCellValue('E1', 'Date');

        // Fetch data from database
        $activities = Activity::all();

        // Populate data rows
        $row = 2; // Starting from row 2 since row 1 is header
        foreach ($activities as $activity) {
            $sheet->setCellValue('A' . $row, $activity->nom_projet);
            $sheet->setCellValue('B' . $row, $activity->duree_debut);
            $sheet->setCellValue('C' . $row, $activity->duree_fin);
            $sheet->setCellValue('D' . $row, $activity->description);
            $sheet->setCellValue('E' . $row, $activity->date);
            $row++;
        }

        // Create writer and save file
        $writer = new Xlsx($spreadsheet);
        $filename = 'activities-' . date('Y-m-d-H-i-s') . '.xlsx';
        $writer->save($filename);

        // Return the file as a download
        return response()->download($filename, $filename)->deleteFileAfterSend();
    }

   
}
