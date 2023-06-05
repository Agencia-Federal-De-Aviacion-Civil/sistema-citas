<?php

namespace App\Listeners\Medicine;

use App\Jobs\ExportSelectedJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Log\LogManager;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;

class ExportJobProcessedListener
{
    protected $logger;
    public function __construct(LogManager $logger)
    {
        $this->logger = $logger;
    }
    public function handle($event)
    {
        $payload = $event->job->payload();

        // Verifica si el trabajo en la cola es del tipo ExportSelectedJob
        if ($payload['displayName'] === ExportSelectedJob::class) {
            Cache::put('exportJobProcessed', true, 60); // 1440 minutos = 24 horas
        }
    }
}
