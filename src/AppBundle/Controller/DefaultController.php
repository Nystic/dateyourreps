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
    	$router = $this->get('router');
    	$login_url = $router->generate('fos_user_security_login');
    	$register_url = $router->generate('fos_user_registration_register');
    	$logout_url = $router->generate('fos_user_security_logout');
    	$current_user = $this->get('security.token_storage')->getToken();
        return new Response('<html><body>Hello, '.($current_user->getUser() == 'anon.' ? 'would you like to <a href="'.$login_url.'">log in</a>?' : $current_user->getUser().'!').' You\'re '.($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') ? 'an admin! <a href="'.$logout_url.'">Logout</a>' : ($current_user->getUser() == 'anon.' ? 'anonymous! Would you like to <a href="'.$register_url.'">register</a>?' : 'a user! <a href="'.$logout_url.'">Logout</a>')).'</body></html>');
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
