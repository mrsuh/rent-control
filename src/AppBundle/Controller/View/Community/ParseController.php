<?php

namespace AppBundle\Controller\View\Community;

use AppBundle\Document\Community\Parse;
use AppBundle\Exception\AppException;
use AppBundle\Form\Community\Parse\CreateForm;
use AppBundle\Session\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/cities/{city_id}/communities/parse")
     * @Method({"GET"})
     */
    public function listByCityAction($city_id)
    {
        $list = $this->get('model.community.parse')->findAll();
        return $this->render('AppBundle:Community/Parse:list.html.twig', ['list' => $list]);
    }

    /**
     * @Route("/cities/{city_id}/communities/parse/new")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(CreateForm::class, new Parse());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->get('model.community.parse')->create($form->getData());

                $this->addFlash(Message::SUCCESS, 'Success');

                return $this->redirectToRoute('app_view_city_city_list');
            } catch (AppException $e) {
                $this->addFlash(Message::WARNING, $e->getMessage());
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $this->addFlash(Message::WARNING, 'An error has occurred');
            }
        }

        return $this->render(
            'AppBundle:City:item.html.twig',
            [
                'form' => $form->createView()
            ]);
    }
}
