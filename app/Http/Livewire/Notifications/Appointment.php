<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;

class Appointment extends Component
{
    public $notifications, $count;
    // protected $listeners = ['notification'];
    public function mount()
    {
        $this->notification();
    }
    public function resetNotificationCount()
    {
        auth()->user()->notification = 0;
        auth()->user()->save();
    }
    public function read($notification_id)
    {
        $notification = auth()->user()->Notifications()->findOrFail($notification_id);
        $notification->markAsRead();
    }
    public function notification()
    {
        $this->notifications = auth()->user()->Notifications;
        $this->count = auth()->user()->unreadNotifications->count();
    }
    public function render()
    {
        return view('livewire.notifications.appointment');
    }
}
