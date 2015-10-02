<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ServiceBundle\Controller\TermbasesController;

class TermbasesSelectController extends Controller
{	
	public function getAllAction()
	{
		$TermbasesController = new TermbasesController();
		$result = $TermbasesController->getAllAction();
		$termbases = json_decode($result);
		$forms = array();
		
		foreach ($termbases as $termbase)
		{
			$form = $this->createFormBuilder($termbase)
				->add('id', 'hidden')
				->add('save', 'submit', array('label' => 'View this Termbase'))
				->getForm();
			
			array_push($forms, array('form' => $form, 'termbase' => $termbase));
		}
		
		return $this->render(
			'forms/termbases_select.html.twig',
			array('forms'=>$forms)
		);
	}
}