<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentGenerate extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public $userAppointment)
    {
        // dd($this->userAppointment->from_user_appointment)->name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Se ha agendado una nueva cita.')
            ->action('Notification Action', url('/'))
            ->line('Gracias!');
    }

    public function toDatabase($notifiable)
    {
        $notifiable->notification += 1;
        $notifiable->save();
        return [
            'url' => 'www.google.com',
            'message' => User::find($this->userAppointment->from_user_appointment)->name . ' ' . 'ha agendado una nueva cita.',
        ];
    }
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
