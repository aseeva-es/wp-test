<?php

namespace App;

use GuzzleHttp\Client;

class Weather
{
    private $client;
    private $latitude;
    private $longitude;

    public function __construct(float $latitude = 60.1695, float $longitude = 24.9354)
    {
        $this->client = new Client();
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    private function buildUrl(): string
    {
        return sprintf(
            'https://api.open-meteo.com/v1/forecast?latitude=%f&longitude=%f&current=temperature_2m,relative_humidity_2m',
            $this->latitude,
            $this->longitude
        );
    }

    private function fetchWeatherData(): array
    {
        $response = $this->client->request('GET', $this->buildUrl());
        return json_decode($response->getBody(), true);
    }

    public function getCurrentWeather($url): array
    {
        $data = $this->fetchWeatherData();
        
        return [
            'temperature' => $data['current']['temperature_2m'],
            'humidity' => $data['current']['relative_humidity_2m']
        ];
    }
}