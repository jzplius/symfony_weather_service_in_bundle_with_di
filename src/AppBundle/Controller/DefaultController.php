<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Nfq\Bundle\WeatherBundle;

class DefaultController extends Controller
{
    /**
     * @Route("/weather", name="homepage")
     */
    public function indexAction()
    {
        $weather_api = $this->get('nfq.weather');
        $temp = $weather_api->getTemperatureForLocation();

        return $this->render('default/index.html.twig', array(
            'temp' => $temp,
        ));
    }
}
