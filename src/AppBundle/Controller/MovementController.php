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
		$movements = $this->getDoctrine()
			->getRepository('AppBundle:Movement')
			->findAll();

		return $this->render('AppBundle:Movement:showall.html.twig', array(
            'movements' => $movements
        ));

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

		return $this->render('AppBundle:Movement:show.html.twig', array(
            'movement' => $movement
        ));

	}

	function joinAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$movement = $em->getRepository('AppBundle:Movement')
			->find($id);

		if (!$movement) {
			throw $this->createNotFoundException(
				'No movement found with the ID: '.$id
			);
		}

		$userManager = $this->container->get('fos_user.user_manager');
		$user = $userManager->findUserByUsername($this->get('security.token_storage')->getToken()->getUser());

		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException(
				'You must have a user account and be logged in to join a Movement.'
			);
    	}

    	$movement->getUsers()->add($user);
    	$user->getMovements()->add($movement);

    	$em->persist($movement);
    	$em->flush();

    	return new Response('<html><body>Joined successfully!</body></html>');
	}

	function leaveAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$movement = $em->getRepository('AppBundle:Movement')
			->find($id);

		if (!$movement) {
			throw $this->createNotFoundException(
				'No movement found with the ID: '.$id
			);
		}

		$userManager = $this->container->get('fos_user.user_manager');
		$user = $userManager->findUserByUsername($this->get('security.token_storage')->getToken()->getUser());

		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException(
				'You must have a user account and be logged in to join a Movement.'
			);
    	}

    	$movement->removeUser($user);
    	$user->removeMovement($movement);

    	$em->persist($movement);
    	$em->flush();

    	return new Response('<html><body>Left successfully!</body></html>');
	}

	function createAction()
	{

	}
} 