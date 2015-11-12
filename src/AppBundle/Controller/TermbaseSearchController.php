<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ServiceBundle\Controller\TermbaseController;
use ServiceBundle\Controller\EntryController;

class TermbaseSearchController extends Controller
{
    /**
     * @Route("/termbase/search", name="search_termbase")
     */
    public function searchAction(Request $request)
    {

		if (!empty($request->request->get('form')['id']))
		{
			$id = $request->request->get('form')['id'];
		}
		else
		{
			$id = $request->attributes->get('id');
		}
		// $termbase = new TermbaseController();
		// $termbase->get($id);
		$form = $this->createFormBuilder()
				->add('termbaseId', 'hidden', array('data' => $id))
				->add('addEntry', 'submit', array('label' => 'Add a New Entry'))
				->getForm();
		
		return $this->render(
			'default/search.html.twig',
			array('id'=>$id, 'newEntryForm'=>$form)
		);
    }
	
	/**
     * @Route("/termbase/search.js", name="search_termbase_js")
     */
	public function scriptAction($id)
	{
		$entryController = new EntryController($id);
		$entries_json = $entryController->getAll();
		$entries = json_decode($entries_json);
		
		return $this->render( 
			'default/js/search.js.twig',
			array('entries'=>$entries,'id'=>$id)
		);
	}
	
		/**
     * @Route("/termbase/lang_codes.json", name="lang_codes_list")
     */
	public function jsonLoadAction()
	{
		return $this->render( 
			'default/js/isoLangCodes.json'
		);
	}
}
