<?php

namespace App\Actions\Fortify;

use App\Models\Catalogue\LogsApi;
use App\Models\Medicine\medicine_history_movements;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();

            medicine_history_movements::create([
                'user_id' => $user->id,
                'action' => 'ACTUALIZACIÓN',
                'process' => $input['name'].' ACTUALIZO CORREO: '.$input['email']
            ]);
        }
        $this->email($user->id, $user->email);
    }



    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();
        $user->sendEmailVerificationNotification();
    }

    public function email($id, $email)
    {
        if (checkdnsrr('crp.sct.gob.mx', 'A')) {
            // dump($this->id_save);
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])->connectTimeout(30)->put(
                'https://siafac.afac.gob.mx/updateEmail?',
                [
                    'id_update' => $id,
                    'email' => $email,
                ]
            );
            if ($response->successful()) {
                $statesSuccess = $response->json()['data'];
            } elseif ($response->successful() && $response->json()['data'] === 'NO EXITOSO') {
            } else {
                $error = $response->json()['message'];
                $this->LogsApi($curp_logs = $id, $type = 'ACTUALIZACION DE CORREO', $register = $error, $description = 'ERROR AL REALIZAR REGISTRO DE USURIO');
            }
        }
    }

    public function LogsApi($curp_logs, $type, $register, $description)
    {
        $url = url()->previous();
        $logs =  LogsApi::create([
            'curp_logs' => $curp_logs,
            'url' => $url,
            'type' => $type,
            'register' => $register,
            'description' => $description
        ]);
    }
}
