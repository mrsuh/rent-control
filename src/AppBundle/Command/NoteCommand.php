<?php

namespace AppBundle\Command;

use Schema\Note\Contact;
use Schema\Note\Note;
use Schema\Parse\Record\Source;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NoteCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:note');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dm_factory = $this->getContainer()->get('dm.default');
        $dm_note    = $dm_factory->init(Note::class);

        $begin = new \DateTime( '2018-01-01' );
        $end = new \DateTime( '2018-12-31' );

        $interval = new \DateInterval('PT1M');
        $daterange = new \DatePeriod($begin, $interval ,$end);

        $sources = [Source::TYPE_AVITO, Source::TYPE_VK_COMMENT, Source::TYPE_VK_WALL];
        foreach($daterange as $date){
            echo $date->format('Y-m-d H:i:s') . PHP_EOL;

            $note = (new Note())
                ->setTimestamp($date->getTimestamp())
                ->setContact(new Contact())//todo
                ->setSource($sources[array_rand($sources, 1)]);

            if ($note) {
                $dm_note->insert($note);
            }

        }

        return true;
    }
}
