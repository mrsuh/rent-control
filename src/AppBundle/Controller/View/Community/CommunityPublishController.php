<?php

namespace AppBundle\Controller\View\Community;

use AppBundle\Document\Community\CommunityPublish;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CommunityPublishController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/communities/publish")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $repo = $this->get('odm.hot.data.mapper.factory')->init(CommunityPublish::class);
        return $this->render('AppBundle:Community/Publish:list.html.twig', ['list' => $repo->find()]);
    }
}
