<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ServiceBundle\Controller\TermbaseController;
use ServiceBundle\Controller\TermbasesController;
use ServiceBundle\Controller\EntryController;
use ServiceBundle\Controller\PersonController;

class TermbaseSearchController extends Controller
{
    /**
     * @Route("/termbase/search", name="search_termbase")
     */
    public function searchAction(Request $request)
    {

		$id = $request->request->get('form')['id'];
		$name = $request->request->get('name');
		$response = 'response';

		// $termbase = new TermbaseController();
		// $termbase->get($id);
		$form = $this->createFormBuilder()
				->add('termbaseId', 'hidden', array('data' => $id))
				->add('addEntry', 'submit', array('label' => 'Add a New Entry'))
				->getForm();
		
		return $this->render(
			'default/search.html.twig',
			array('id'=>$id, 'newEntryForm'=>$form, 'name'=>$name)
		);
    }    
	
	/**
     * @Route("/termbase/search_all", name="search_termbase_all")
     */
    public function searchAllAction(Request $request)
    {
		
		return $this->render(
			'default/search_all.html.twig'
		);
    }    
	
	/**
     * @Route("/termbase/search/mini", name="search_termbase_mini")
     */
    public function miniSearchAction(Request $request)
    {
		$e = $request->request->get('e');
		$l = $request->request->get('l');
		$t = $request->request->get('t');
		$targetElementId = $request->request->get('targetElementId');
		
		return $this->render(
			'default/search_mini.html.twig',
			array('e'=>$e,'l'=>$l,'t'=>$t,'targetElementId'=>$targetElementId)
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
		
		$personController = new PersonController($id);
		$persons_json = $personController->getAll();
		$persons = json_decode($persons_json);
		
		return $this->render( 
			'default/js/search.js.twig',
			array('entries'=>$entries,'id'=>$id, 'persons'=>$persons)
		);
	}
	
	/**
     * @Route("/termbase/search_all.js", name="search_termbase_all_js")
     */
	public function scriptAllAction()
	{
		$entries_list = array();
		$tc = new TermbasesController();
		$termbases = json_decode($tc->getAllAction());
		
		foreach ($termbases as $termbase)
		{
			$entryController = new EntryController($termbase->id);
			$entries_json = $entryController->getAll();
			$entries = json_decode($entries_json);

			array_push($entries_list,$entries);
		}
		
		return $this->render( 
			'default/js/search_all.js.twig',
			array('entries_list'=>$entries_list)
		);
	}
	
	/**
     * @Route("/termbase/editFields.js", name="edit_termbase_js")
     */
	public function scriptAdminAction()
	{	
		return $this->render( 
			'default/js/editFields.js.twig'
		);
	}
	
	/**
     * @Route("/termbase/lang_codes.json", name="lang_codes_list")
     */
	public function langJsonLoadAction()
	{
		return $this->render( 
			'default/js/isoLangCodes.json'
		);
	}
	
	/**
     * @Route("/termbase/region_codes.json", name="region_codes_list")
     */
	public function regionJsonLoadAction()
	{
		return $this->render( 
			'default/js/regionCodes.json'
		);
	}
}
