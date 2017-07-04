<?php

namespace AppBundle\Controller\View\Note;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class NoteController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/notes")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.note')->findAll();
        return $this->render('AppBundle:Note:list.html.twig', ['list' => $list]);
    }
}
