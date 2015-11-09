<?php

namespace uGovernUserBundle\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseProfileController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ProfileController extends BaseProfileController 
{
	function viewUserAction($id)
	{
		$userManager = $this->get('fos_user.user_manager');
		$user = $userManager->findUserBy(array('id' => $id));

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user
        ));
	}
} 