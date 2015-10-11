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

		$id = $request->request->get('form')['id'];
		
		// $termbase = new TermbaseController();
		// $termbase->get($id);
		
		return $this->render(
			'default/search.html.twig',
			array('id'=>$id)
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
