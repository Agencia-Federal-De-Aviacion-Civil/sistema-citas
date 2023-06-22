<?php

namespace App\Http\Livewire\Medicine;

use App\Models\Medicine\MedicineExportHistory;
use Illuminate\Support\Facades\Auth;
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
        $queryExports = MedicineExportHistory::where('auth', Auth::user()->id)->latest()->first();
        $querySend = $queryExports->auth . '-' . $queryExports->created_at;
        $filePath = 'medicina-preventiva/exports/' . $querySend . '.xlsx';
        $disk = Storage::disk('do');
        if ($disk->exists($filePath)) {
            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="reporte-citas.xlsx"',
            ];
            MedicineExportHistory::find($queryExports->id)->delete();
            return response()->streamDownload(function () use ($disk, $filePath) {
                $fileStream = $disk->readStream($filePath); // Obtener el flujo del archivo
                while (!feof($fileStream)) {
                    echo fread($fileStream, 8192); // Imprimir el contenido del archivo
                }
                fclose($fileStream); // Cerrar el flujo del archivo
                $disk->delete($filePath); // Eliminar el archivo después de ser descargado
            }, 'reporte-citas-' . $querySend . '.xlsx', $headers);
        } else {
            abort(404);
        }
    }
    public function render()
    {
        return view('livewire.medicine.appointment-medicine');
    }
}
