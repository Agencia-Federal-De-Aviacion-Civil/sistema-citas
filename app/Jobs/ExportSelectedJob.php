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
use Maatwebsite\Excel\Facades\Excel;

class ExportSelectedJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $results, $userId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($results)
    {
        $this->results = $results;
        if (Auth::user()) {
            $this->userId = Auth::user()->id;
        } else {
            $this->userId = null;
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $filePath = 'medicina-preventiva/exports/' . $this->userId . '.xlsx';
            Excel::store(new AppointmentExport($this->results), $filePath, 'do');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
