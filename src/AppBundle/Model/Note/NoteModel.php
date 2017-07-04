<?php

namespace AppBundle\Model\Note;

use AppBundle\Document\Note\Note;
use ODM\DocumentMapper\DataMapperFactory;

class NoteModel
{
    private $dm_note;

    /**
     * NoteModel constructor.
     * @param DataMapperFactory $dm
     */
    public function __construct(DataMapperFactory $dm)
    {
        $this->dm_note = $dm->init(Note::class);
    }

    /**
     * @return array|\ODM\Document\Document[]
     */
    public function findAll()
    {
        return $this->dm_note->find();
    }
}
