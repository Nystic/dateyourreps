<?php

namespace uGovernUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('uGovernUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
