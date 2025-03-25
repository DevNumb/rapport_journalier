<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Worker;
use App\Models\Project;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $filePath = base_path('database\seeders\dbwork.xlsx');
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach ($rows as $index => $row) {
            if ($index === 0) continue;

            $duree_debut = $row[4] ?? null;
            $duree_fin = $row[5] ?? null;
            $workerId = $row[7] ?? null;
            $projectId = $row[8] ?? null;

            // Skip if any required fields are empty
            if (empty($workerId) || empty($projectId) || empty($duree_debut) || empty($duree_fin)) {
                \Log::warning("Skipping task in row " . ($index + 1) . " due to missing required data");
                continue;
            }

            // Check if worker_id exists
            if (!Worker::where('id', $workerId)->exists()) {
                \Log::warning("Worker ID {$workerId} does not exist in row " . ($index + 1));
                continue;
            }

            // Check if project_id exists
            if (!Project::where('id', $projectId)->exists()) {
                \Log::warning("Project ID {$projectId} does not exist in row " . ($index + 1));
                continue;
            }

            $hours = $this->calculateHours($duree_debut, $duree_fin);

            Task::create([
                'title' => $row[1],
                'description' => $row[2],
                'status' => $row[3],
                'duree_debut' => $duree_debut,
                'duree_fin' => $duree_fin,
                'hours' => $hours,
                'worker_id' => $workerId,
                'project_id' => $projectId,
                'system_date' => $row[9],
            ]);
        }
    }

    private function calculateHours(?string $startTime, ?string $endTime): float
    {
        if (empty($startTime) || empty($endTime)) {
            \Log::warning("Skipping hours calculation due to empty start/end time");
            return 0;
        }

        try {
            $start = Carbon::createFromFormat('H:i', $startTime);
            $end = Carbon::createFromFormat('H:i', $endTime);

            return $end->diffInMinutes($start) / 60;
        } catch (\Exception $e) {
            \Log::error("Error calculating hours: " . $e->getMessage() .
                       " Start Time: " . $startTime .
                       " End Time: " . $endTime);
            return 0;
        }
    }
}
