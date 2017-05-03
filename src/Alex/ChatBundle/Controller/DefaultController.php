<?php

namespace Alex\ChatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        echo "<pre>" . var_dump($user) . "</pre>";exit;
        return $this->render( 'ChatBundle:Default:index.html.twig');
    }
}
