<?php

namespace Alex\ChatBundle\Controller;

use Alex\ChatBundle\Entity\Message;
use Alex\ChatBundle\Entity\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ChatBundle:Default:index.html.twig');
    }

    public function saveMessageAction(Request $request)
    {
        if (!empty($request->getContent())) {
            $userMessage = $request->getContent();
            $user = $this->getUser();

            $message = new Message();
            $message->setBody($userMessage);
            $message->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return new JsonResponse(['status' => 'ok']);
        } else {

            return new JsonResponse(['status' => 'message not saved'], 500);
        }
    }

    public function getMessagesAction(Request $request)
    {
        $messages = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('ChatBundle:Message')
            ->findAll();

        return new JsonResponse($messages);
    }

    public function getNewMessagesAction($lastMessageId, Request $request)
    {
        if ($this->getDoctrine()->getManager()->getRepository('ChatBundle:Message')->findOneBy(['id' => $lastMessageId + 1])) {
            $newMessages = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('ChatBundle:Message')
                ->findNewMessage($lastMessageId);

            return new JsonResponse($newMessages);
        } else {

            return new JsonResponse(['status' => 'no new messages']);
        }
    }

    public function getUsersAction()
    {
        /** @var User $user */
        $user = $this->getUser();
        $this->loggingLastOnlineUser($user);

        $dataNow = new DateTime("now");
        $timeOnline = $dataNow->modify("-2 minutes");

        $usersOnline = $this
            ->getDoctrine()
            ->getRepository('ChatBundle:User')
            ->findUsersOnline($timeOnline);

        return new JsonResponse($usersOnline);
    }

    public function loggingLastOnlineUser(User $user)
    {
        $user->setLastOnline(new DateTime("now"));

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

    }
}
