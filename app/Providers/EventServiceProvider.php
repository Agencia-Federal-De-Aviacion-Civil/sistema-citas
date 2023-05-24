<?php

namespace App\Providers;

use App\Models\Security\InformationUserActivity;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Device;
use Sinergi\BrowserDetector\Os;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(Authenticated::class, function ($event) {
            $request = request();
            if (!$request->session()->has('user_information_logged')) {
                $ip = $request->ip();
                $browser = new Browser($request->header('User-Agent'));
                $os = new Os($request->header('User-Agent'));
                $browserName = $browser->getName();
                $osName = $os->getName();

                InformationUserActivity::create([
                    'user_id' => Auth::user()->id,
                    'ip' => $ip,
                    'browser' => $browserName,
                    'platform' => $osName,
                ]);
                $request->session()->put('user_information_logged', true);
            }
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
