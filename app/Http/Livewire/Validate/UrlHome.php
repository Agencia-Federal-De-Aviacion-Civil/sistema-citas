<?php

namespace App\Http\Livewire\Validate;

use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Crypt;
use Jenssegers\Date\Date;
use Livewire\Component;

class UrlHome extends Component
{
    public $keyEncrypt, $dateNow;
    public function mount($keyEncrypt)
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
        $this->keyEncrypt = $keyEncrypt;
        try {
            $decrypted = Crypt::decryptString($keyEncrypt);
            $separated = explode('*', $decrypted);
            // Rest of your code to process decrypted data...

            $this->keyEncrypt = $keyEncrypt;
        } catch (\Exception $e) {
            // Handle decryption error
            // You can redirect to a specific route or view here
            return Redirect::route('errorViewRoute'); // Change 'errorViewRoute' to your actual error view route
        }
    }
    public function render()
    {
        $decrypted = Crypt::decryptString($this->keyEncrypt);
        $separated = explode('*', $decrypted);
        $medicine_id = $separated[0];
        $date_reserve = $separated[1];
        $curp = $separated[2];
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine.medicineUser.userParticipant', 'medicineReserveFromUser', 'medicineReserveHeadquarter'])
            ->whereHas('medicineReserveMedicine.medicineUser.userParticipant', function ($q) use ($curp) {
                $q->where('curp', $curp);
            })->where('id', $medicine_id)
            ->where('dateReserve', $date_reserve)->get();
        return view('livewire.validate.url-home', compact('medicineReserves'));
    }
}
