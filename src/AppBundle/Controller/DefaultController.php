<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
		return $this->render('AppBundle:Default:index.html.twig', array(
            'user' => $user
        ));
    }

    /**
     * @Route("/admin/")
     */
    public function adminAction()
    {
    	$router = $this->get('router');
    	$url = $router->generate('fos_user_security_login');
    	$current_user = $this->get('security.token_storage')->getToken()->getUser();
        return new Response('<html><body>Hello, '.($current_user->getUsername() == 'anon.' ? 'whould you like to <a href="'.$url.'">log in</a>?' : $current_user->getUsername()).'! You\'re '.($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') ? 'an admin!' : 'a user!').'</body></html>');
    }
}
