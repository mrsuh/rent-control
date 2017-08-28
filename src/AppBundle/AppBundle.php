<?php

namespace AppBundle;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    public function __construct()
    {
        AnnotationReader::addGlobalIgnoredName('ODM\Collection');
        AnnotationReader::addGlobalIgnoredName('ODM\Field');
    }
}
