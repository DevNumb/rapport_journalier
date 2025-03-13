<?php

namespace App\Http\Controllers;

use App\Models\Journalier;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class JournalierController extends Controller
{
    /**
     * Display a listing of the journaliers.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $journaliers = Journalier::when($search, function ($query, $search) {
            return $query->where('nom', 'like', '%' . $search . '%')
                ->orWhere('projet', 'like', '%' . $search . '%');
        })->get();

        return view('journaliers.index', compact('journaliers'));
    }

    /**
     * Show the form for creating a new journalier.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('journaliers.create');
    }

    /**
     * Store a newly created journalier in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'projet' => 'required|string|max:255',
            'duree_debut' => 'required|date_format:H:i',
            'duree_fin' => 'required|date_format:H:i',
            'description' => 'nullable|string',
        ]);
    
        Journalier::create([
            'nom' => $request->nom,
            'projet' => $request->projet,
            'duree_debut' => $request->duree_debut,
            'duree_fin' => $request->duree_fin,
            'description' => $request->description,
            'date' => Carbon::today()  // Explicitly set date
        ]);
    
        return redirect()->route('journaliers.index')->with('success', 'Entry created successfully.');
    }
    
    /**
     * Display the specified journalier.
     *
     * @param  \App\Models\Journalier  $journalier
     * @return \Illuminate\View\View
     */
    public function show(Journalier $journalier)
    {
         $date = Carbon::today()->format('Y-m-d'); // Get the current date in YYYY-MM-DD format
        return view('journaliers.show', compact('journalier', 'date')); // Pass the date to the view
    }

    /**
     * Show the form for editing the specified journalier.
     *
     * @param  \App\Models\Journalier  $journalier
     * @return \Illuminate\View\View
     */
        public function edit(Journalier $journalier)
    {
        return view('journaliers.edit', compact('journalier'));
    }

    /**
     * Update the specified journalier in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Journalier  $journalier
     * @return \Illuminate\Http\RedirectResponse
     */


public function update(Request $request, Journalier $journalier)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'projet' => 'required|string|max:255',
        'duree_debut' => 'required|date_format:H:i',
        'duree_fin' => 'required|date_format:H:i',
        'description' => 'nullable|string',
    ]);

    $journalier->update([
        'nom' => $request->nom,
        'projet' => $request->projet,
        'duree_debut' => $request->duree_debut,
        'duree_fin' => $request->duree_fin,
        'description' => $request->description,
        'date' => Carbon::now()->format('Y-m-d'), // Set date to current date
    ]);

    return redirect()->route('journaliers.index')->with('success', 'Journalier entry updated successfully.');
}
    /**
     * Remove the specified journalier from storage.
     *
     * @param  \App\Models\Journalier  $journalier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Journalier $journalier)
    {
        $journalier->delete();

        return redirect()->route('journaliers.index')->with('success', 'Journalier entry deleted successfully.');
    }

    public function export()
{
    $journaliers = Journalier::all();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set header row
    $sheet->setCellValue('A1', 'Nom');
    $sheet->setCellValue('B1', 'Projet');
    $sheet->setCellValue('C1', 'Duree Debut');
    $sheet->setCellValue('D1', 'Duree Fin');
    $sheet->setCellValue('E1', 'Description');
    $sheet->setCellValue('F1', 'Date');

    // Populate data rows
    $row = 2; // Starting from row 2 since row 1 is header
    foreach ($journaliers as $journalier) {
        $sheet->setCellValue('A' . $row, $journalier->nom);
        $sheet->setCellValue('B' . $row, $journalier->projet);
        $sheet->setCellValue('C' . $row, $journalier->duree_debut);
        $sheet->setCellValue('D' . $row, $journalier->duree_fin);
        $sheet->setCellValue('E' . $row, $journalier->description);
        $sheet->setCellValue('F' . $row, $journalier->date);
        $row++;
    }

    // Create writer and save file
    $writer = new Xlsx($spreadsheet);
    $filename = 'journaliers-' . date('Y-m-d-H-i-s') . '.xlsx';
    $writer->save($filename);

    // Return the file as a download
    return response()->download($filename, $filename)->deleteFileAfterSend();
}



}
