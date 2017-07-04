<?php

namespace AppBundle\Controller\View\City;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CityController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/cities")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.city')->findAll();
        return $this->render('AppBundle:City:list.html.twig', ['list' => $list]);
    }
}
