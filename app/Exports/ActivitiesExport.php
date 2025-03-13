<?php

namespace App\Exports;

use App\Models\Activity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivitiesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $activities = Activity::all();
        $data = $activities->map(function ($activity) {
            return [
                'Nom Projet' => $activity->project_name,
                'Duree Debut' => $activity->start_duration,
                'Duree Fin' => $activity->end_duration,
                'Description' => $activity->description,
                'Date' => $activity->date,
            ];
        });
        return $data;
    }

    public function headings(): array
    {
        return [
            'Nom Projet',
            'Duree Debut',
            'Duree Fin',
            'Description',
            'Date',
        ];
    }
}
