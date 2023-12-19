<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;
class MyVerifyEmail extends VerifyEmail
{
    public function toMail($notifiable)
    {

        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        $someHtmlBody="<div align='center'><img src='https://citas-medicina.afac-avciv.com/images/logoafac.png'></div>";

        return (new MailMessage)
            ->subject('Verificación de Correo electronico')
            ->greeting(new HtmlString($someHtmlBody))
            ->line('Bienvenido!')
            ->line('Para poder acceder al sistema de citas de la AFAC porfavor dar clic en el botón para verificar su dirección de correo electronico.')
            ->action('Verificar correo electronico', $verificationUrl)
            ->line('Si no creó una cuenta, no se requiere ninguna otra acción.')
            ->salutation('Agencia Federal de Aviación Civil');
    }
}
