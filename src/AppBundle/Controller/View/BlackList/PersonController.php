<?php

namespace AppBundle\Controller\View\BlackList;

use AppBundle\Document\BlackList\Record;
use AppBundle\Exception\AppException;
use AppBundle\Form\BlackList\CreateForm;
use AppBundle\Session\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PersonController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/persons")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.blacklist.person')->findAll();
        return $this->render('AppBundle:BlackList/Person:list.html.twig', ['list' => $list]);
    }

    /**
     * @Route("/persons/new")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(CreateForm::class, (new Record())->setType(Record::TYPE_PERSON));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {

                $this->get('model.blacklist.person')->create($form->getData());

                $this->addFlash(Message::SUCCESS, 'Success');

                return $this->redirectToRoute('app_view_blacklist_person_list');
            } catch (AppException $e) {
                $this->addFlash(Message::WARNING, $e->getMessage());
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $this->addFlash(Message::WARNING, 'An error has occurred');
            }
        }

        return $this->render(
            'AppBundle:BlackList/Person:item.html.twig',
            [
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/persons/{record_id}")
     * @Method({"GET", "POST"})
     */
    public function editAction($record_id, Request $request)
    {
        $record = $this->get('model.blacklist.person')->findOneById($record_id);

        if(null === $record) {

            throw new NotFoundHttpException();
        }

        $form = $this->createForm(CreateForm::class, $record);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {

                $this->get('model.blacklist.person')->update($form->getData());

                $this->addFlash(Message::SUCCESS, 'Success');

                return $this->redirectToRoute('app_view_blacklist_person_list');
            } catch (AppException $e) {
                $this->addFlash(Message::WARNING, $e->getMessage());
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $this->addFlash(Message::WARNING, 'An error has occurred');
            }
        }

        return $this->render(
            'AppBundle:BlackList/Person:item.html.twig',
            [
                'form' => $form->createView()
            ]);
    }
}
