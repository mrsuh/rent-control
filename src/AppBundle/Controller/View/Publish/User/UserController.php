<?php

namespace AppBundle\Controller\View\Publish\User;

use AppBundle\Exception\AppException;
use AppBundle\Form\Publish\User\CreateForm;
use AppBundle\Session\Message;
use Schema\Publish\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.document.publish.user')->findAll();
        return $this->render('AppBundle:Publish\User:list.html.twig', ['list' => $list]);
    }

    /**
     * @Route("/new")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(CreateForm::class, new User());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->get('model.document.publish.user')->create($form->getData());

                $this->addFlash(Message::SUCCESS, 'Success');

                return $this->redirectToRoute('app_view_publish_user_user_list');
            } catch (AppException $e) {
                $this->addFlash(Message::WARNING, $e->getMessage());
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $this->addFlash(Message::WARNING, 'An error has occurred');
            }
        }

        return $this->render(
            'AppBundle:Publish\User:item.html.twig',
            [
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/{user_id}")
     * @Method({"GET", "POST"})
     */
    public function editAction($user_id, Request $request)
    {
        $user = $this->get('model.document.publish.user')->findOneById($user_id);

        if(null === $user) {

            throw new NotFoundHttpException();
        }

        $form = $this->createForm(CreateForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->get('model.document.publish.user')->update($form->getData());

                $this->addFlash(Message::SUCCESS, 'Success');

                return $this->redirectToRoute('app_view_publish_user_user_list');
            } catch (AppException $e) {
                $this->addFlash(Message::WARNING, $e->getMessage());
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $this->addFlash(Message::WARNING, 'An error has occurred');
            }
        }

        return $this->render(
            'AppBundle:Publish\User:item.html.twig',
            [
                'form' => $form->createView()
            ]);
    }
}
