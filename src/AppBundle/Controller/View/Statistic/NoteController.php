<?php

namespace AppBundle\Controller\View\Statistic;

use Schema\City\City;
use AppBundle\Exception\AppException;
use AppBundle\Form\City\CreateForm;
use AppBundle\Session\Message;
use Schema\Parse\Record\Source;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NoteController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response

     * @Route("/note")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $list = $this->get('model.document.note')->findPeriod((new \DateTime())->modify('- 1 month'), (new \DateTime()));

        $notes = [
            Source::TYPE_VK_WALL => [],
            Source::TYPE_VK_COMMENT => [],
            Source::TYPE_AVITO => [],
        ];
        $labels = [];
        foreach($list as $note) {
            $dt = \DateTime::createFromFormat('U',$note->getTimestamp());
            $date = $dt->format('Y.m.d');

            if(!array_key_exists($date, $notes[$note->getSource()])) {
                $notes[$note->getSource()][$date] = 0;
            }

            if(!in_array($date, $labels)) {
                $labels[] = $date;
            }

            $notes[$note->getSource()][$date]++;
        }

        return $this->render('AppBundle:Statistic:note.html.twig', ['list' => $notes, 'labels' => $labels]);
    }
}
