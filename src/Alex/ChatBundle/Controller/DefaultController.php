<?php

namespace Alex\ChatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
//        $user = $this->getUser();
        return $this->render( 'ChatBundle:Default:index.html.twig');
    }
}
