<?php

namespace AppBundle\Controller\View\Publish\Record;

use Schema\Publish\Record\Record;
use AppBundle\Exception\AppException;
use AppBundle\Form\Publish\Record\CreateForm;
use AppBundle\Session\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RecordController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.document.publish.record')->findAll();

        return $this->render('AppBundle:Publish\Record:list.html.twig', ['list' => $list]);
    }

    /**
     * @Route("/new")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $cities = [];
        foreach ($this->get('model.document.city')->findAll() as $city) {
            $cities[$city->getShortName()] = $city->getShortName();
        }

        $users = [];
        foreach ($this->get('model.document.publish.user')->findAll() as $city) {
            $users[$city->getUsername()] = $city->getUsername();
        }

        $form = $this->createForm(CreateForm::class, new Record(), [
            'cities' => $cities,
            'users'  => $users
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->get('model.document.publish.record')->create($form->getData());

                $this->addFlash(Message::SUCCESS, 'Success');

                return $this->redirectToRoute('app_view_publish_record_record_list');
            } catch (AppException $e) {
                $this->addFlash(Message::WARNING, $e->getMessage());
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $this->addFlash(Message::WARNING, 'An error has occurred');
            }
        }

        return $this->render(
            'AppBundle:Publish\Record:item.html.twig',
            [
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/{record_id}")
     * @Method({"GET", "POST"})
     */
    public function editAction($record_id, Request $request)
    {
        $record = $this->get('model.document.publish.record')->findOneById($record_id);

        if (null === $record) {

            throw new NotFoundHttpException();
        }

        $cities = [];
        foreach ($this->get('model.document.city')->findAll() as $city) {
            $cities[$city->getShortName()] = $city->getShortName();
        }

        $users = [];
        foreach ($this->get('model.document.publish.user')->findAll() as $city) {
            $users[$city->getUsername()] = $city->getUsername();
        }

        $form = $this->createForm(CreateForm::class, $record, [
            'cities' => $cities,
            'users'  => $users
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->get('model.document.publish.record')->update($form->getData());

                $this->addFlash(Message::SUCCESS, 'Success');

                return $this->redirectToRoute('app_view_publish_record_record_list');
            } catch (AppException $e) {
                $this->addFlash(Message::WARNING, $e->getMessage());
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $this->addFlash(Message::WARNING, 'An error has occurred');
            }
        }

        return $this->render(
            'AppBundle:Publish\Record:item.html.twig',
            [
                'form' => $form->createView()
            ]);
    }
}
