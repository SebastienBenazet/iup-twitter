<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/u/{username}", name="user_message")
     */
    public function indexAction(User $user)
    {
        $messages = $this->getDoctrine()
            ->getRepository('AppBundle:Message')
            ->findByOrderedByDateAndByUser($user);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $messages,
            1,
            5
        );

        return $this->render('default/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
