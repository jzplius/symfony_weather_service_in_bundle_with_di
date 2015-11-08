<?php

namespace Nfq\Bundle\WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NfqWeatherBundle:Default:index.html.twig', array('name' => $name));
    }
}
