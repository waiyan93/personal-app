<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExchangeRateResource;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new \GuzzleHttp\Client();
        $resExchangeRates = $client->request('GET', 'http://forex.cbm.gov.mm/api/latest');
        $weatherApiKey = 'a935532f2ccef242c00b64b6a3a05f7d';
        $resWeather = $client->request(
            'GET', 
            'http://api.openweathermap.org/data/2.5/weather?q=Yangon&&units=metric',
            [
                'headers' => [
                    'Accept'    => 'application/json',
                    'x-api-key' => $weatherApiKey
                ]
            ]
        );
        $resWeather = json_decode($resWeather->getBody());
        $resExchangeRates = json_decode($resExchangeRates->getBody());
        $exchangeRatesResource = new ExchangeRateResource($resExchangeRates);
        $exchangeRates =  [
            'USD' => $exchangeRatesResource->rates->USD,
            'EURO' => $exchangeRatesResource->rates->EUR
        ];
        $date = Carbon::now()->format('d/M/Y');
        // dd($resWeather);
        return view('admin.index', ['date' => $date, 'exchangeRates' => $exchangeRates, 'weather' => $resWeather]);
    }
}
