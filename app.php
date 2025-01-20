<?php 
require_once __DIR__ . '/vendor/autoload.php';
use App\Weather;
use Dotenv\Dotenv;

$dotenv= Dotenv::createImmutable(__DIR__);
$dotenv->load();



$weather = new Weather();
$currentWeather = $weather->getCurrentWeather($_ENV['API_URL']);

echo "Current weather in Helsinki:\n";
echo "Temperature: {$currentWeather['temperature']}°C\n";
echo "Humidity: {$currentWeather['humidity']}%\n";