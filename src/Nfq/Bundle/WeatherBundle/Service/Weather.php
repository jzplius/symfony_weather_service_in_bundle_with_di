<?php
/**
 * Created by PhpStorm.
 * User: jzplius
 * Date: 15.11.7
 * Time: 21.05
 */
namespace Nfq\Bundle\WeatherBundle\Service;
use Monolog\Handler\Curl;
use Nfq\Bundle\WeatherBundle\OwmWeatherProvider;

class Weather
{
    public function __construct($latitude, $longitude)
    {
        // Add your weather provider, that extends WeatherProviderInterface
        $provider = new OwmWeatherProvider;

        $this->provider = $provider;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /** Returns a temperature in Celsius for selected latitude and longitude
     * @param null $latitude - optional
     * @param null $longitude - optional
     * @return float temperature in Celsius
     */
    public function getTemperatureForLocation($latitude = null, $longitude = null) {
        $this->validateData($latitude, $longitude);

        $response = $this->provider->getResponse($this->latitude, $this->longitude);
        $temperature = $this->provider->extractTemperature($response);
        $temperatureInCelsius = $this->provider->getTemperatureInCelsius($temperature);

        return $temperatureInCelsius;
    }

    public function validateData($latitude, $longitude) {
        if (isset($latitude) && (is_float($latitude) || is_int($latitude)) && $latitude >= -90 && $latitude <= 90) {
            $this->latitude = $latitude;
        }
        if (isset($longitude) && (is_float($longitude) || is_int($longitude)) && $longitude >= -180 && $longitude <= 180) {
            $this->longitude = $longitude;
        }
    }

    /**
     * Make a post request and return server response
     * @param $url
     * @return string response
     */
    public static function getApiResponse($url){

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt($ch,CURLOPT_TIMEOUT, 20);

        $response = curl_exec($ch);

        return strval($response);
    }

    public static function fahrenheitToCelsius($value) {
        return number_format(((intval($value) - 32) * 5 / 9), 1);
    }

    public static function kelvinToCelsius($value) {
        return number_format((intval($value) - 273.15), 1);
    }
}