<?php

namespace AppBundle\Controller\View\BlackList;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PersonController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/persons")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.blacklist.person')->findAll();
        return $this->render('AppBundle:City:list.html.twig', ['list' => $list]);
    }
}
