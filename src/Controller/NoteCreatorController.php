<?php

namespace EresNote\Controller;

use EresNote\Domain\Entity\Note;
use EresNote\Domain\Repository\NoteRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class NoteCreatorController
{
    public function create(Request $request, ValidatorInterface $validator, NoteRepositoryInterface $noteRepository)
    {
        $note = new Note();

        $note->title = $request->get('title', "");
        $note->cotnent = $request->get('content', "");
        $note->creationTimestamp = $request->get('creationTimestampo', "");
        $note->user = $request->get('user', "");

        $errors = $validator->validate($note);

        if ($errors->count() == 0) {
            $noteRepository->persist($note);
        }

        return new Response();

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
