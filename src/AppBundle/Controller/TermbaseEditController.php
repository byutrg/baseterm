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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ServiceBundle\Controller\TermbaseController;
use ServiceBundle\Controller\TermbasesController;
use ServiceBundle\Controller\EntryController;

class TermbaseEditController extends Controller
{
	/**
     * @Route("/termbase/importView", name="import_view_termbase")
     */
    public function importViewAction(Request $request)
    {

		// $termbase = new TermbaseController();
		// $termbase->get($id);
		
		$form = $this->createFormBuilder()
				->add('file', 'file', array('label'=>' '))
				->add('upload', 'submit')
				->getForm()
				->createView();
		
		return $this->render(
			'forms/termbase_import.html.twig',
			array('form'=>$form)
		);
    }
		
	/**
     * @Route("/termbase/import", name="import_termbase")
     */
    public function importAction(Request $request)
    {	
		$fileName = $request->files->get('form')['file']->getClientOriginalName();
		$filePath = $request->files->get('form')['file']->getPathName();

		$termbases = $this->get('termbases_controller');
		$response = $termbases->import($filePath, $fileName);

		return $this->redirectToRoute('termbase_list');
    }

    /**
     * @Route("/termbase/create", name="create_termbase")
     */
    public function createAction(Request $request)
    {

		// $termbase = new TermbaseController();
		// $termbase->get($id);
		
		$form = $this->createFormBuilder()
				->getForm();
		
        $languages = $this->getDoctrine()
				->getRepository('AppBundle:Language')
				->findAll();
		
		$languageDict = array();
		foreach ($languages as $lang)
		{
			$code = preg_split("/,/", $lang->getCodes())[0];

			$languageDict[$code] = $lang->getName();
		}
        asort($languageDict);
		return $this->render(
			'default/createTermbase.html.twig',
			array('form'=>$form, 'languages'=>$languageDict)
		);
    }
	
	/**
	* @Route("/termbase/save", name="save_termbase")
	*/
	public function saveAction(Request $request)
	{
		$working_language = $request->request->get('languageCode');
		$name = $request->request->get('termbase_name').".tbx";
		
		$termbase = $this->get('termbase_controller');
		
		$termbase->create($working_language, $name);
		
		$response = '';
		if (!empty($termbase->baseId))
		{
			$response = $this->redirectToRoute('termbase_list');
		}
		else
		{
			$response = $this->redirectToRoute('termbase_list');
		}
		
		return $response;
	}
	
	/**
     * @Route("/termbase/create.js", name="create_termbase_js")
     */
	public function scriptAction()
	{
		return $this->render( 
			'default/js/create.js.twig',
			array()
		);
	}
	
	/**
	* @Route("/termbase/delete", name="delete_termbase")
	*/
	public function deleteAction(Request $request)
	{ 
		$id = $request->query->get('id');
		
		$termbase = $this->get('termbase_controller');
		
		$termbase->get($id);
		$termbase->delete();
		
		$response = new Response('success');
		
		return $response;
	}
}
