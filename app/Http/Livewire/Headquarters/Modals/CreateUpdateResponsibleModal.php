<?php

namespace App\Http\Livewire\Headquarters\Modals;

use App\Models\User;
use App\Models\UserHeadquarter;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class CreateUpdateResponsibleModal extends ModalComponent
{
    use Actions;
    public $userId, $name, $password, $passwordConfirmation, $email;
    public function mount($userId)
    {
        $this->userId = $userId;
    }
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:passwordConfirmation'
        ];
    }
    public function render()
    {
        $queryResponsibles = UserHeadquarter::with('userHeadquarterUser')->where('headquarter_id', $this->userId)->get();
        return view('livewire.headquarters.modals.create-update-responsible-modal', compact('queryResponsibles'));
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    public static function closeModalOnEscape(): bool
    {
        return false;
    }
    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
    public function clean()
    {
        $this->reset(['name', 'email', 'password']);
    }
    public function save()
    {
        $this->validate();
        $userSave = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ])->assignRole('headquarters');
        UserHeadquarter::create(
            [
                'headquarter_id' => $this->userId,
                'user_id' => $userSave->id
            ]
        );
        $this->clean();
        // $this->closeModal();
        $this->notification([
            'title'       => 'AÑADIDO EXITOSAMENTE',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
    }
    public function delete($idDelete)
    {
        UserHeadquarter::find($idDelete)->delete();
        $this->notification([
            'title'       => 'ELIMINADO EXITOSAMENTE',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
    }
    public function messages()
    {
        return [
            'name.required' => 'Campo obligatorio',
            'email.required' => 'Campo obligatorio',
            'email.email' => 'Correo no valido',
            'email.unique' => 'Correo electrónico ya existe',
            'password.required' => 'Campo obligatorio',
            'password.min' => 'Mínimo 6 carácteres',
            'password.same' => 'La contraseña no coíncide'
        ];
    }
}
