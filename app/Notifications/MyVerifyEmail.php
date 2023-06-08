<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class MyVerifyEmail extends VerifyEmail
{
    public function toMail($notifiable)
    {

        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }
        return (new MailMessage)
            ->subject('Verificación de Correo electronico')
            ->greeting('Estimado(a)')
            ->line('Porfavor dar clic en el botón para verificar tu correo electronico.')
            ->action('Verificar correo electronico', $verificationUrl)
            ->line('Si no creó una cuenta, no se requiere ninguna otra acción.')
            ->salutation('Agencia Federal de Aviación Civil');
    }
}
