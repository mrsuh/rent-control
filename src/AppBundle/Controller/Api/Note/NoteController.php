<?php

namespace AppBundle\Controller\Api\Note;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NoteController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("{note_id}")
     * @Method({"DELETE"})
     */
    public function deleteAction($note_id)
    {
        $note = $this->get('model.document.note')->findOneById($note_id);

        if(null === $note) {

            return new JsonResponse(['status' => 'err', 'data' => 'note not found'], Response::HTTP_NOT_FOUND);
        }

        try {

            $this->get('model.document.note')->delete($note);

        } catch(\Exception $e) {
            $this->get('logger')->error($e->getMessage());

            return new JsonResponse(['status' => 'err', 'data' => 'internal server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['status' => 'ok', 'data' => null]);
    }
}
