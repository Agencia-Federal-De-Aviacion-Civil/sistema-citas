<?php

namespace App\Jobs;

use App\Exports\ScheduledExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExportSelectedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $results;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($results)
    {
        $this->results = $results;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // try {
        //     $fileName = 'scheduled.xlsx';
        //     // $path = storage_path('app/public/' . $fileName);
        //     $filePath = 'uploads/citas-app/medicine/exports/scheduled.xlsx';

        //     Excel::store(new ScheduledExport($this->results), $filePath,'do');

        //     return $filePath;
        // } catch (\Exception $e) {
        //     dd($e->getMessage());
        // }
        // FUNCIONA PERO FALTA DESCARGAR
        try {
            // $fileName = 'scheduled.xlsx';
            $filePath = 'uploads/citas-app/medicine/exports/schedules.xlsx';

            Excel::store(new ScheduledExport($this->results), $filePath, 'do');

            // $url = Storage::disk('do')->url($filePath);
            $fileContents = Storage::disk('do')->get($filePath);
            // Storage::disk('do')->delete($filePath);
            return response()->streamDownload(function () use ($fileContents) {
                echo $fileContents;
            }, 'schedules.xlsx');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
    }


