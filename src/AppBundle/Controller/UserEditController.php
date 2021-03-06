<?php
/*
 *  This file is part of BaseTerm.
 *  
 *  BaseTerm is an open-source and free to use terminology management system built with the primary goal of natively supporting the most popular TBX dialect for exchange, TBX-Basic
 *  
 *  Copyright © (2015-2017) BYU TRG & LTAC Global & CRITI
 *  
 *  See the LICENSE file that accompanied this source code for the full license
 *  information
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ServiceBundle\Controller\TermbasesController;
use ServiceBundle\Controller\PersonController;

class UserEditController extends Controller
{	
	/**
     * @Route("/users", name="manage_users")
     */
	public function viewAction(Request $request)
	{
		$userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
		
		$data = array();
		foreach ($users as $user)
		{
			$form = $this->createFormBuilder()
					->add('name', 'hidden', array('data'=>$user))
					->add('save', 'submit', array('label' => 'Save Role'))
					->getForm();

			array_push($data, array('form'=>$form->createView(), 'name'=>$user));
		}

		return $this->render(
			'default/edit_users.html.twig',
			array('users'=>$users, 'data'=>$data)
		);
	}

	/**
     * @Route("/users/user_role", name="user_role_edit")
     */
	public function roleUpdateAction(Request $request)
	{
		$name = $request->request->get('form')['name'];
		$role_raw = $request->request->get('role');

		$userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($name);

		$roles = array();
		switch($role_raw)
		{
			case 'user':
				$role = array('ROLE_USER');
				break;
			case 'staff':
				$role = array('ROLE_STAFF');
				break;
			case 'admin':
				$role = array('ROLE_ADMIN');
				break;
			case 'inactive':
				$role = array('ROLE_INACTIVE');
				break;
		}

		$user->setRoles($role);
		$userManager->updateUser($user);

		return $this->redirectToRoute('manage_users');
	}
	
	/**
     * @Route("/users/personId", name="user_personId_edit")
     */
	public function setPersonIdAction(Request $request)
	{
		$name = $request->request->get('name');
		$personId = $request->request->get('pid');

		$userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($name);
		
		$user->setPersonId($personId);
		
		$userManager->updateUser($user);
		
		return new Response('SUCCESS');
	}
	
	/**
     * @Route("/users/add_person", name="user_person_add")
     */
	public function addPersonAction(Request $request)
	{
		$tid = $request->request->get('tid');
		$name = $request->request->get('name');
		$person = $request->request->get('person');

		$userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($name);
		
		$personController = $this->get('person_controller');
        $personController->setPath($tid);
		$result = json_decode($personController->postPerson($person));
		
		$pid = $result->created;
		
		$user->setPersonId($pid);
		
		$userManager->updateUser($user);
		
		return new Response($pid);
	}
}