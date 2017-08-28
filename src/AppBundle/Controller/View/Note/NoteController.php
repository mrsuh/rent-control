<?php

namespace AppBundle\Controller\View\Note;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class NoteController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("")
     * @Method({"GET"})
     */
    public function listAction(Request $request)
    {
        $page = $request->query->get('page');
        $paginator = $this->get('model.document.note')->paginateAll($page ? $page : 1);

        $subways = [];
        foreach($this->get('model.document.subway')->findAll() as $subway) {
            $subways[$subway->getId()] = $subway;
        }

        return $this->render('AppBundle:Note:list.html.twig', [
            'paginator' => $paginator,
            'subways' => $subways
        ]);
    }
}
