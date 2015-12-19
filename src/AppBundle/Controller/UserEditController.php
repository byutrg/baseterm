<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ServiceBundle\Controller\TermbasesController;

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
}