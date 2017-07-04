<?php

namespace AppBundle\Controller\View\BlackList;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PhoneController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/phones")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.blacklist.phone')->findAll();
        return $this->render('AppBundle:City:list.html.twig', ['list' => $list]);
    }
}
