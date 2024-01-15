<?php

namespace App\Console\Commands;

use App\Models\Medicine\MedicineReserve;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PendingAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dateNowParse = Carbon::now()->format('Y-m-d');
        $medicineReserves = MedicineReserve::whereDate('dateReserve', '>=', $dateNowParse)->where('status', 0)->get();
        foreach ($medicineReserves as $medicineReserve) {
            $dateParse = Carbon::parse($medicineReserve->dateReserve);
            $addDaysParse = $dateParse->addWeekdays(3)->format('Y-m-d');
            if ($addDaysParse <= $dateNowParse) {
                $medicineReserve->update([
                    'status' => 11
                ]);
            } else {
                Log::channel('update-appointment')->info($medicineReserve . ' - ' . 'AUN ESTA EN PEDIENTE' . 'DIAS AÑADIDOS---' . $addDaysParse);
            }
        };
    }
}
