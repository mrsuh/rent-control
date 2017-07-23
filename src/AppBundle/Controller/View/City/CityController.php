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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @Route("/cities/new")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(CreateForm::class, new City());

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
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

    /**
     * @Route("/cities/{city_id}")
     * @Method({"GET", "POST"})
     */
    public function editAction($city_id, Request $request)
    {
        $city = $this->get('model.city')->findOneById($city_id);

        if(null === $city) {
            throw new NotFoundHttpException();
        }

        $form = $this->createForm(CreateForm::class, $city);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            try {

                $this->get('model.city')->update($form->getData());

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
