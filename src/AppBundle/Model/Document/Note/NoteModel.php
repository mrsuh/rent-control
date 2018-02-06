<?php

namespace AppBundle\Model\Document\Note;

use Schema\Note\Note;
use ODM\DocumentManager\DocumentManagerFactory;
use ODM\Paginator\Paginator;

class NoteModel
{
    private $dm_note;

    /**
     * NoteModel constructor.
     * @param DocumentManagerFactory $dm
     */
    public function __construct(DocumentManagerFactory $dm)
    {
        $this->dm_note = $dm->init(Note::class);
    }

    /**
     * @param int $current_page
     * @return Paginator
     */
    public function paginateAll(int $current_page = 1)
    {
        $query = $this->dm_note->createQuery();
        return Paginator::paginate($query, $current_page);
    }

    /**
     * @return array|Note[]
     */
    public function findAll()
    {
        return $this->dm_note->find();
    }

    /**
     * @return array|Note[]
     */
    public function findPeriod(\DateTime $from, \DateTime $to)
    {
        return $this->dm_note->find(['timestamp' => ['$lt' => $to->getTimestamp() , '$gt' => $from->getTimestamp()]]);
    }

    /**
     * @return null|Note
     */
    public function findOneById($id)
    {
        return $this->dm_note->findOne(['_id' => $id]);
    }

    /**
     * @param Note $note
     * @return bool
     */
    public function delete(Note $note)
    {
        $this->dm_note->delete($note);

        return true;
    }
}
