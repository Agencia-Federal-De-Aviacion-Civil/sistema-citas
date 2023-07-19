<?php

namespace App\Http\Livewire\Headquarters\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\User;
use App\Models\UserHeadquarter;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class CreateUpdateResponsibleModal extends ModalComponent
{
    use Actions;
    public $userId, $nameHeadquarter;
    public function mount($userId)
    {
        $this->userId = $userId;
        $this->nameHeadquarter = Headquarter::with('HeadquarterUserHeadquarter')
            ->where('id', $userId)->get();
    }
    public function render()
    {
        $queryResponsibles = UserHeadquarter::with('userHeadquarterUserParticipant')->where('headquarter_id', $this->userId)->get();
        return view('livewire.headquarters.modals.create-update-responsible-modal', compact('queryResponsibles'));
    }
    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return 'md';
    }
    public static function closeModalOnEscape(): bool
    {
        return false;
    }
    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
