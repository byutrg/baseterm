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
		$entryObject = $request->query->get('entry');
		$id = $request->query->get('termbaseId');
		
		$entry = new EntryController($id);
		$result = $entry->addEntry($entryObject);
		
		return new Response($result);
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
	
	
}