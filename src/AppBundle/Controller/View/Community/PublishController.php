<?php

namespace AppBundle\Controller\View\Community;

use AppBundle\Document\Community\Publish;
use AppBundle\Exception\AppException;
use AppBundle\Form\Community\Publish\CreateForm;
use AppBundle\Session\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/cities/{city_id}/communities/publish")
     * @Method({"GET"})
     */
    public function listByCityAction()
    {
        $list = $this->get('model.community.publish')->findAll();
        return $this->render('AppBundle:Community/Publish:list.html.twig', ['list' => $list]);
    }

    /**
     * @Route("/cities/{city_id}/communities/publish/new")
     * @Method({"GET", "POST"})
     */
    public function createAction($city_id, Request $request)
    {
        $form = $this->createForm(CreateForm::class, new Publish());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->get('model.community.publish')->create($form->getData());

                $this->addFlash(Message::SUCCESS, 'Success');

                return $this->redirectToRoute('app_view_community_publish_listbycity', ['city_id' => $city_id]);
            } catch (AppException $e) {
                $this->addFlash(Message::WARNING, $e->getMessage());
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $this->addFlash(Message::WARNING, 'An error has occurred');
            }
        }

        return $this->render(
            'AppBundle:Community/Publish:item.html.twig',
            [
                'form' => $form->createView()
            ]);
    }
}
