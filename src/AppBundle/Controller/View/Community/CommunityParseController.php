<?php

namespace AppBundle\Controller\View\Community;

use AppBundle\Document\Community\CommunityParse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CommunityParseController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/communities/parse")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $repo = $this->get('odm.hot.data.mapper.factory')->init(CommunityParse::class);
        return $this->render('AppBundle:Community/Parse:list.html.twig', ['list' => $repo->find()]);
    }
}
