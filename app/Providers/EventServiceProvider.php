<?php

namespace App\Providers;

use App\Models\Security\InformationUserActivity;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
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
                $crawlerDetect = new CrawlerDetect();
                $isCrawler = $crawlerDetect->isCrawler($request->header('User-Agent'));
                $browserName = $browser->getName();
                $osName = $os->getName();
                if (!$isCrawler) {
                    // Llave de API de ipapi
                    $apiKey = 'f93317b0c1527ae4e51e39a8b42373c0';

                    // Crea una instancia del cliente Guzzle HTTP
                    $client = new Client();

                    // Realiza una solicitud a la API de ipapi para obtener la ubicación
                    // $response = $client->get("https://ipapi.co/{$ip}/json/?key={$apiKey}");
                    $response = $client->get("http://api.ipapi.com/{$ip}/?access_key={$apiKey}&output=json");
                    // Decodifica la respuesta JSON
                    $ubicacion = json_decode($response->getBody(), true);
                    $pais = $ubicacion['country_name'];
                    $region = $ubicacion['region_name'];
                    $ciudad = $ubicacion['city'];
                    $latitud = $ubicacion['latitude'];
                    $longitud = $ubicacion['longitude'];
                    InformationUserActivity::create([
                        'user_id' => Auth::user()->id,
                        'ip' => $ip,
                        'browser' => $browserName,
                        'platform' => $osName,
                        'country' => $pais,
                        'region' => $region,
                        'city' => $ciudad,
                        'latitude' => $latitud,
                        'longitude' => $longitud,
                    ]);
                }
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
