<?php

namespace App\Jobs;

use App\Exports\ScheduledExport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Date\Date;
use Maatwebsite\Excel\Facades\Excel;

class ExportSelectedJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
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
        try {
            $date = Date::now();
            $filePath = 'medicina-preventiva/exports/report-appointment.xlsx';
            Excel::store(new ScheduledExport($this->results), $filePath, 'do');
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
