<?php

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

		$termbases = new TermbasesController();
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
		
		return $this->render(
			'default/createTermbase.html.twig',
			array('form'=>$form)
		);
    }
	
	/**
	* @Route("/termbase/save", name="save_termbase")
	*/
	public function saveAction(Request $request)
	{
		$working_language = $request->request->get('languageCode');
		$name = $request->request->get('termbase_name').".tbx";
		
		$termbase = new TermbaseController();
		
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
		
		$termbase = new TermbaseController();
		
		$termbase->get($id);
		$termbase->delete();
		
		$response = new Response('success');
		
		return $response;
	}
}
