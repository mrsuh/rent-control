<?php

namespace AppBundle\Model\Note;

use AppBundle\Document\Note\Note;
use ODM\DocumentManager\DocumentManagerFactory;

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
     * @return array|Note[]
     */
    public function findAll()
    {
        return $this->dm_note->find();
    }
}
