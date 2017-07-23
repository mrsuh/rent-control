<?php

namespace AppBundle\Controller\View\ParseList;

use AppBundle\Document\ParseList\Record;
use AppBundle\Exception\AppException;
use AppBundle\Form\ParseList\CreateForm;
use AppBundle\Session\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ParseListController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.parse_list')->findAll();
        return $this->render('AppBundle:ParseList:list.html.twig', ['list' => $list]);
    }

    /**
     * @Route("/new")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $cities = [];
        foreach($this->get('model.city')->findAll() as $city) {
            $cities[$city->getShortName()] = $city->getShortName();
        }

        $form = $this->createForm(CreateForm::class, new Record(), ['cities' => $cities]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {

                $this->get('model.parse_list')->create($form->getData());

                $this->addFlash(Message::SUCCESS, 'Success');

                return $this->redirectToRoute('app_view_parselist_parselist_list');
            } catch (AppException $e) {
                $this->addFlash(Message::WARNING, $e->getMessage());
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $this->addFlash(Message::WARNING, 'An error has occurred');
            }
        }

        return $this->render(
            'AppBundle:ParseList:item.html.twig',
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
        $record = $this->get('model.parse_list')->findOneById($record_id);

        if(null === $record) {

            throw new NotFoundHttpException();
        }

        $cities = [];
        foreach($this->get('model.city')->findAll() as $city) {
            $cities[$city->getShortName()] = $city->getShortName();
        }

        $form = $this->createForm(CreateForm::class, $record, ['cities' => $cities]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->get('model.parse_list')->update($form->getData());

                $this->addFlash(Message::SUCCESS, 'Success');

                return $this->redirectToRoute('app_view_parselist_parselist_list');
            } catch (AppException $e) {
                $this->addFlash(Message::WARNING, $e->getMessage());
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $this->addFlash(Message::WARNING, 'An error has occurred');
            }
        }

        return $this->render(
            'AppBundle:ParseList:item.html.twig',
            [
                'form' => $form->createView()
            ]);
    }
}
