<?php

namespace EresNote\Controller;

use EresNote\Domain\Entity\Note;
use EresNote\Domain\Repository\NoteRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class NoteCreatorController extends CreatorTemplate
{

//    public function create(Request $request, ValidatorInterface $validator, NoteRepositoryInterface $noteRepository)
//    {
//        $note = new Note();
//
//        $note->title = $request->get('title', "");
//        $note->content = $request->get('content', "");
//        $note->creationTimestamp = $request->get('creationTimestamp', "");
//        $note->user = $request->get('user', 1);
//
//        $errors = $validator->validate($note);
//
//        if ($errors->count() == 0) {
//            $noteRepository->persist($note);
//        }
//
//        return new Response("Done");
//
//    }
//    /**
//     *  @ParamConverter("note", options={"mapping": {"title": "title", "content": "content", "id":"id"}})
//     */
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
