<?php

namespace AppBundle\Controller\View\BlackList;

use AppBundle\Document\BlackList\Phone;
use AppBundle\Exception\AppException;
use AppBundle\Form\BlackList\Phone\CreateForm;
use AppBundle\Session\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class PhoneController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/phones")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.blacklist.phone')->findAll();
        return $this->render('AppBundle:BlackList/Phone:list.html.twig', ['list' => $list]);
    }

    /**
     * @Route("/phones/new")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(CreateForm::class, new Phone());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {

                $this->get('model.blacklist.phone')->create($form->getData());

                $this->addFlash(Message::SUCCESS, 'Success');

                return $this->redirectToRoute('app_view_blacklist_phone_list');
            } catch (AppException $e) {
                $this->addFlash(Message::WARNING, $e->getMessage());
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $this->addFlash(Message::WARNING, 'An error has occurred');
            }
        }

        return $this->render(
            'AppBundle:BlackList/Phone:item.html.twig',
            [
                'form' => $form->createView()
            ]);
    }
}
