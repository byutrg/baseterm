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
		$entryObject = $request->query->get('entry');
		$id = $request->query->get('termbaseId');
		
		$entry = new EntryController($id);
		$entry->setId($entryObject['id']);
		$response = $entry->updateEntry($entryObject);
		
		return new Response(json_encode($response));
	}
}