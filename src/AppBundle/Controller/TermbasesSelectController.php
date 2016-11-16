<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ServiceBundle\Controller\TermbasesController;
use ServiceBundle\Controller\TermbaseController;

class TermbasesSelectController extends Controller
{	
	public function getAllAction()
	{
		$TermbasesController = new TermbasesController();
		$result = $TermbasesController->getAllAction();
		$termbases = json_decode($result);
		$forms = array();
		
		if (isset($termbases))
		{
			foreach ($termbases as $termbase)
			{
				$form = $this->createFormBuilder($termbase)
					->add('id', 'hidden')
					->add('save', 'submit', array('label' => 'View/Edit'))
					->getForm();


				array_push($forms, array('form' => $form->createView(), 'termbase' => $termbase));
			}
		}
		
		return $this->render(
			'forms/termbases_select.html.twig',
			array('forms'=>$forms)
		);
	}
	
	/**
     * @Route("/termbase/export", name="export_termbase")
     */
	public function exportAction(Request $request)
	{
		$id = $request->query->get('id');
		
		$termbase = new TermbaseController();
		$termbase->get($id);
		
		return new Response($termbase->exportToFile());
	}
}