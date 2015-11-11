<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movement;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MovementController extends Controller
{
	function viewAllAction()
	{
		$movement = $this->getDoctrine()
			->getRepository('AppBundle:Movement')
			->findAll();

		$response = '';

		foreach($movement as $movement)
		{
			$response .= $movement->getTitle().', <a href="'.$this->generateUrl('app_movements_join', array('id' => $movement->getId())).'">join</a>.<br>';
		}

		return new Response($response);

	}

	function viewAction($id)
	{
		$movement = $this->getDoctrine()
			->getRepository('AppBundle:Movement')
			->find($id);

		if (!$movement) {
			throw $this->createNotFoundException(
				'No movement found with the ID: '.$id
			);
		}

		$joinRoute = $this->generateUrl('app_movements_join', array('id' => $id));

		return new Response($movement->getTitle().', <a href="'.$joinRoute.'">join</a>.');

	}

	function joinAction($id)
	{
		$movement = $this->getDoctrine()
			->getRepository('AppBundle:Movement')
			->find($id);

		if (!$movement) {
			throw $this->createNotFoundException(
				'No movement found with the ID: '.$id
			);
		}

		$userManager = $this->container->get('fos_user.user_manager');
		$user = $userManager->findUserByUsername($this->container->get('security.context')->getToken()->getUser());

		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException(
				'You must have a user account and be logged in to create a Movement.'
			);
    	}

    	// Get the movement's movers list, unserialize it, add the user, reserialize and send it back
		$movers = $movement->getMovers();
		if (!in_array($user->getId(), $movers))
		{
			$movers[] = $user->getId();
			$movement->setMovers($movers);
		}
		else 
		{
			throw $this->createAccessDeniedException(
				'You\'ve already joined this Movement!'
			);
		}

		$em = $this->getDoctrine()->getManager();
		$em->persist($movement);
		$em->flush();

    	// Get the user's movement list, unserialize it, add the movement, reserialize and send it back
		$movements = $user->getMovements();
		if (!in_array($id, $movements))
		{
			$movements[] = $id;
			$user->setMovements($movements);
		}
		else 
		{
			throw $this->createAccessDeniedException(
				'You\'ve already joined this Movement!'
			);
		}

		$em = $this->getDoctrine()->getManager();
		$em->persist($user);
		$em->flush();

		return new Response('Joined successfully! <a href="'.$this->generateUrl('app_movements_view', array('id' => $movement->getId())).'">View Movement</a>.');
	}

	function createAction()
	{

	}
} 