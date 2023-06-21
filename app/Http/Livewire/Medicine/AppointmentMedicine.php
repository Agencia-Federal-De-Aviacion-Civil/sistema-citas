<?php

namespace App\Http\Livewire\Medicine;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Jenssegers\Date\Date;

class AppointmentMedicine extends Component
{
    public $batchId;
    public $exporting;
    public $exportFinished,$dateNow;
    protected $listeners = ['BatchDispatch'];
    public function mount()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
    }
    public function BatchDispatch($data)
    {
        $this->batchId = $data[0];
        $this->exporting = $data[1];
        $this->exportFinished = $data[2];
    }
    public function getExportBatchProperty()
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }
    public function updateExportProgress()
    {
        $this->exportFinished = $this->exportBatch->finished();

        if ($this->exportFinished) {
            $this->exporting = false;
        }
    }
    public function downloadExport()
    {
        $filePath = 'medicina-preventiva/exports/report-appointment.xlsx';
        $disk = Storage::disk('do');
        if ($disk->exists($filePath)) {
            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="report-appointment.xlsx"',
            ];
            return $disk->download($filePath, 'report-appointment.xlsx', $headers);
        } else {
            abort(404);
        }
    }
    public function render()
    {
        return view('livewire.medicine.appointment-medicine');
    }
}
