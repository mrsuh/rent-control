<?php

namespace AppBundle\Controller\View\Parse\Record;

use Schema\Parse\Record\Source;
use AppBundle\Exception\AppException;
use AppBundle\Form\Parse\Record\SourceForm;
use AppBundle\Session\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SourceController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("")
     * @Method({"GET"})
     */
    public function listAction($record_id)
    {
        $record = $this->get('model.document.parse.record')->findOneById($record_id);

        if(null === $record) {

            throw new NotFoundHttpException();
        }

        return $this->render('AppBundle:Parse\Record\Source:list.html.twig', [
            'list' => $record->getSources(),
            'record' => $record
        ]);
    }

    /**
     * @Route("/new")
     * @Method({"GET", "POST"})
     */
    public function createAction($record_id, Request $request)
    {
        $record = $this->get('model.document.parse.record')->findOneById($record_id);

        if(null === $record) {

            throw new NotFoundHttpException();
        }

        $form = $this->createForm(SourceForm::class, new Source());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {

                $source = $form->getData();
                $source->setCity($record->getCity());
                $record->addSource($source);

                $this->get('model.document.parse.record')->update($record);

                $this->addFlash(Message::SUCCESS, 'Success');

                return $this->redirectToRoute('app_view_parse_record_source_list', ['record_id' => $record_id]);
            } catch (AppException $e) {
                $this->addFlash(Message::WARNING, $e->getMessage());
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $this->addFlash(Message::WARNING, 'An error has occurred');
            }
        }

        return $this->render(
            'AppBundle:Parse\Record\Source:item.html.twig',
            [
                'form' => $form->createView(),
                'record' => $record
            ]);
    }

    /**
     * @Route("/{source_id}")
     * @Method({"GET", "POST"})
     */
    public function editAction($record_id, $source_id, Request $request)
    {
        $record = $this->get('model.document.parse.record')->findOneById($record_id);

        if(null === $record) {

            throw new NotFoundHttpException();
        }

        $source = $this->get('model.document.parse.source')->findOneById($record, $source_id);

        if(null === $source) {

            throw new NotFoundHttpException();
        }

        $form = $this->createForm(SourceForm::class, $source);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $source = $form->getData();
                $source->setCity($record->getCity());
                $this->get('model.document.parse.record')->update($record);

                $this->addFlash(Message::SUCCESS, 'Success');

                return $this->redirectToRoute('app_view_parse_record_source_list', ['record_id' => $record_id]);
            } catch (AppException $e) {
                $this->addFlash(Message::WARNING, $e->getMessage());
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $this->addFlash(Message::WARNING, 'An error has occurred');
            }
        }

        return $this->render(
            'AppBundle:Parse\Record\Source:item.html.twig',
            [
                'form' => $form->createView(),
                'record' => $record
            ]);
    }
}
