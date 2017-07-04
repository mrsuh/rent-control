<?php

namespace AppBundle\Controller\View\BlackList;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DescriptionController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/descriptions")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.blacklist.description')->findAll();
        return $this->render('AppBundle:City:list.html.twig', ['list' => $list]);
    }
}
