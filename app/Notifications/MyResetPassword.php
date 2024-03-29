<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class MyResetPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('Recuperar contraseña')
        ->greeting('Estimado(a)')
        ->line('Estás recibiendo este correo porque hiciste una solicitud de recuperación de contraseña para tu cuenta.')
        ->action('Recuperar contraseña', route('password.reset', $this->token))
        ->line('Este enlace de restablecimiento de contraseña caducará en 60 minutos.')
        ->line('Si no realizaste esta solicitud, no se requiere realizar ninguna otra acción.')
        //->salutation('Saludos, '. config('app.name'));
        ->salutation('Saludos, Agencia Federal de Aviación Civil');
    }
}
