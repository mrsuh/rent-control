<?php

namespace AppBundle\Controller\View\Community;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PublishController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/communities/publish")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.community.publish')->findAll();
        return $this->render('AppBundle:Community/Publish:list.html.twig', ['list' => $list]);
    }
}
