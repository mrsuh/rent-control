<?php

namespace AppBundle\Controller;

use AppBundle\Document\Note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $repo = $this->get('odm.hot.data.mapper.factory')->init(Note::class);
        return $this->render('AppBundle:Default:index.html.twig', ['notes' => $repo->find()]);
    }
}
