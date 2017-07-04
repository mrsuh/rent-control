<?php

namespace AppBundle\Controller\View\City;

use AppBundle\Document\City\City;
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
        $repo = $this->get('odm.hot.data.mapper.factory')->init(City::class);
        return $this->render('AppBundle:City:list.html.twig', ['list' => $repo->find()]);
    }
}
