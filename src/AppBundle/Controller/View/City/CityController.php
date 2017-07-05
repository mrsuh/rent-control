<?php

namespace AppBundle\Controller\View\City;

use AppBundle\Document\City\City;
use AppBundle\Exception\AppException;
use AppBundle\Form\City\CreateForm;
use AppBundle\Session\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class CityController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/cities")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.city')->findAll();
        return $this->render('AppBundle:City:list.html.twig', ['list' => $list]);
    }

    /**
     * @Route("/cities/create")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(CreateForm::class, new City());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->get('model.city')->create($form->getData());

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
