<?php

namespace AppBundle\Controller\View\Community;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ParseController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/communities/parse")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.community.parse')->findAll();
        return $this->render('AppBundle:Community/Parse:list.html.twig', ['list' => $list]);
    }
}
