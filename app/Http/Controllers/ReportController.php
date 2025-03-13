<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ReportController extends Controller
{   
    public function index(Request $request)
    {
        $search = $request->input('search');
        $reports = Report::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('module', 'like', '%' . $search . '%');
        })->get();

        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'module' => 'required',
        ]);

        Report::create($request->all());
        return redirect()->route('reports.index')->with('success', 'Report created successfully!');
    }

    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'module' => 'required',
        ]);

        $report->update($request->all());
        return redirect()->route('reports.index')->with('success', 'Report updated successfully!');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully!');
    }

    public function export()
{
    $reports = Report::all();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set header row
    $sheet->setCellValue('A1', 'Name');
    $sheet->setCellValue('B1', 'Description');
    $sheet->setCellValue('C1', 'Module');

    // Populate data rows
    $row = 2; // Starting from row 2 since row 1 is header
    foreach ($reports as $report) {
        $sheet->setCellValue('A' . $row, $report->name);
        $sheet->setCellValue('B' . $row, $report->description);
        $sheet->setCellValue('C' . $row, $report->module);
        $row++;
    }

    // Create writer and save file
    $writer = new Xlsx($spreadsheet);
    $filename = 'reports-' . date('Y-m-d-H-i-s') . '.xlsx';
    $writer->save($filename);

    // Return the file as a download
    return response()->download($filename, $filename)->deleteFileAfterSend();
}
}
