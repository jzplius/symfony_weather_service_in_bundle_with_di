<?php
/**
 * Created by PhpStorm.
 * User: jzplius
 * Date: 15.11.8
 * Time: 12.16
 */

namespace Nfq\Bundle\WeatherBundle;

use Nfq\Bundle\WeatherBundle\Service\Weather;

class OwmWeatherProvider implements WeatherProviderInterface
{
    const API_KEY = "a9353d8de8357f78bc6d9281fc91793e";
    const BASE_API_URL = "http://api.openweathermap.org/data/2.5/weather";

    public function getResponse($latitude, $longitude)
    {
        return Weather::getApiResponse(self::BASE_API_URL . "?lat=" . $latitude . "&lon=" . $longitude . "&appid=" . self::API_KEY);
    }

    public function extractTemperature($data)
    {
        $data = json_decode($data);
        $temperature = $data->main->temp;

        return $temperature;
    }

    public function getTemperatureInCelsius($temperature)
    {
        $temperature = Weather::kelvinToCelsius($temperature);

        return $temperature;
    }
}