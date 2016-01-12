<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ServiceBundle\Controller\TermbaseController;
use ServiceBundle\Controller\EntryController;

Class EditEntryController extends Controller
{
	/**
     * @Route("/termbase/entry/get", name="entry_get")
     */
    public function getAction(Request $request)
    {

		$id = $request->request->get('id');
		
		$entryController = new EntryController($id);
		$entries_json = $entryController->getAll();
		
		return new Response($entries_json);
    }    
	
	
	/**
     * @Route("/termbase/entry/savePage", name="entry_save_page")
     */
	public function savePageViewAction(Request $request)
	{	
		return $this->render(
			'jbox/saveChanges.html.twig'
		);
	}
	
	/**
     * @Route("/termbase/entry/update", name="entry_update")
     */
	public function updateAction(Request $request)
	{
		$entryObject = $request->request->get('entry');
		$id = $request->request->get('termbaseId');
		
		$entry = new EntryController($id);
		$entry->setId($entryObject['id']);
		$response = $entry->updateEntry($entryObject);
		
		return new Response(json_encode($response));
	}
	
	/**
     * @Route("/termbase/entry/delete", name="entry_delete")
     */
	public function deleteAction(Request $request)
	{
		$entryObject = $request->request->get('entry');
		$id = $request->request->get('termbaseId');
		
		$entry = new EntryController($id);
		$entry->setId($entryObject['id']);
		$response = $entry->deleteEntry();
		
		return new Response(json_encode($response));
	}

	/**
	 * @Route("/termbase/entry/upload", name="entry_upload")
	 */
	public function uploadAction(Request $request)
	{
		$entryObject = $request->request->get('entry');
		$id = $request->request->get('termbaseId');
		
		$entry = new EntryController($id);
		$result = $entry->addEntry($entryObject);
		
		return new Response(var_dump($result));
	}
	
	/**
     * @Route("/termbase/entry/new", name="entry_new")
     */
	public function newAction(Request $request)
	{
		$id = $request->request->get('form')['termbaseId'];
		
		return $this->render(
			'default/create_entry.html.twig',
			array('id'=>$id)
		);
	}
	
	/**
	 * @Route("/termbase/entry/new/entry", name="entry_new_entry")
	 */
	public function entryAction()
	{
		return $this->render(
			'forms/entry_level_info.html'
		);
	}
	
	/**
	 * @Route("/termbase/entry/new/lang", name="entry_new_lang")
	 */
	public function langAction()
	{
		return $this->render(
			'forms/lang_level_info.html'
		);
	}
	
	/**
	 * @Route("/termbase/entry/new/term", name="entry_new_term")
	 */
	public function termAction(Request $request)
	{
		$termbaseId = $request->request->get('termbaseId');
		$entryIndex = $request->request->get('entryIndex');
		$langs = $request->request->get('langs');
		$type = $request->request->get('type');

		return $this->render(
			'forms/new_term.html.twig',
			array('termbaseId'=>$termbaseId,'entryIndex'=>$entryIndex,'langs'=>json_encode($langs), 'type'=>$type)
		);
	}
	
	/**
	 * @Route("/termbase/entry/new/ext_ref", name="entry_new_ext_ref")
	 */
	public function extRefAction(Request $request)
	{
		$e = $request->request->get('e');
		$l = $request->request->get('l');
		$t = $request->request->get('t');
		$extRefElementId = $request->request->get('extRefElementId');

		return $this->render(
			'forms/ext_ref.html.twig',
			array('e'=>$e,'l'=>$l,'t'=>$t,'extRefElementId'=>$extRefElementId)
		);
	}
	
	/**
	 * @Route("/termbase/entry/new/image", name="entry_new_image")
	 */
	public function imageAction(Request $request)
	{
		$e = $request->request->get('e');
		$l = $request->request->get('l');
		$t = $request->request->get('t');
		$imgElementId = $request->request->get('imgElementId');

		return $this->render(
			'forms/image.html.twig',
			array('e'=>$e,'l'=>$l,'t'=>$t,'imgElementId'=>$imgElementId)
		);
	}
	
	/**
	 * @Route("/termbase/entry/term/geo", name="entry_term_geo")
	 */
	public function geoAction(Request $request)
	{
		$e = $request->request->get('e');
		$l = $request->request->get('l');
		$t = $request->request->get('t');
		$geoElementId = $request->request->get('geoElementId');

		return $this->render(
			'forms/geo.html.twig',
			array('e'=>$e,'l'=>$l,'t'=>$t,'geoElementId'=>$geoElementId)
		);
	}
	
	/**
	 *	@Route("/termbase/entry/new/term/selectLanguage, name="language_quick_select")
	 */
	public function quickLangSelectAction()
	{
		return $this->render(
			'jbox/language_quick_select.html.twig'
		);
	}	
}
