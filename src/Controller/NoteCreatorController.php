<?php

namespace EresNote\Controller;

use EresNote\Domain\Entity\Note;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class NoteCreatorController
{
    public function create()
    {
        $name = "asrlan";
        return new Response();
    }
}
