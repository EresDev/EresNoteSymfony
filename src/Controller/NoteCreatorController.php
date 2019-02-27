<?php

namespace EresNote\Controller;

use EresNote\Domain\Entity\Note;
use EresNote\Domain\Service\Http\RequestAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class NoteCreatorController
{
    public function create(RequestAdapter $requestAdapter, ValidatorInterface $validator)
    {
        $note = new Note();
        $note->title = ""; //$requestAdapter->getParameter('title', "");

        $errors = $validator->validate($note);

        return new Response($errors->count());

    }

//    public function create(Note $note)
//    {
////        $note = new Note();
////        $note->title = ""; //$requestAdapter->getParameter('title', "");
////
////        $errors = $validator->validate($note);
//
//        return new Response($note->title);
//
//    }
}
