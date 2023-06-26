<?php

namespace App\Jobs;

use App\Exports\AppointmentExport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Maatwebsite\Excel\Facades\Excel;

class ExportSelectedJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $results, $userId, $dateExport, $dataExports;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($results, $dataExports)
    {
        $this->results = $results;
        $this->dataExports = $dataExports;
    }
    public function handle()
    {
        try {
            $filePath = 'medicina-preventiva/exports/' . $this->dataExports . '.xlsx';
            Excel::store(new AppointmentExport($this->results), $filePath, 'do');
        } catch (\Exception $e) {
            echo $e->getMessage();
            // mensaje
        }
    }
}
