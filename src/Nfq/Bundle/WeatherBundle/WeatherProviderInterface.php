<?php

namespace Nfq\Bundle\WeatherBundle;

interface WeatherProviderInterface {
    /** Return response from selected weather API provider for selected coordinates
     * @param $latitude
     * @param $longitude
     * @return mixed
     */
    public function getResponse($latitude, $longitude);

    /** Parse response. extract temperature from it
     * @param $data
     * @return mixed
     */
    public function extractTemperature($data);

    /** Pass extracted temperature and convert it to Celsius if necessary
     * @param $temperature
     * @return mixed
     */
    public function getTemperatureInCelsius($temperature);
}