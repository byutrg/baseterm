<?php

namespace JboxBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ServiceBundle\Controller\TermbaseController;
use ServiceBundle\Controller\EntryController;

class JboxController extends Controller
{
    /**
     * @Route("/termbase/entry/view/small", name="jbox_small")
     */
    public function smallAction(Request $request)
    {
		$entries = json_decode($request->request->get('entries'));
		$nav = $request->request->get('nav');
		$id = $request->request->get('termbaseId');
		
		// $entryController = new EntryController($id);
		// $entries_json = $entryController->getAll();
		// $entries = json_decode($entries_json);
		
		// $termbase = new TermbaseController();
		// $termbase->get($id);
		
		return $this->render(
			'jbox/small.html.twig',
			array('entries'=>$entries, 'e'=>$nav['e'], 'l'=>$nav['l'], 't'=>$nav['t'])
		);
    }
	
	/**
     * @Route("/termbase/entry/view/large", name="jbox_large")
     */
    public function largeAction(Request $request)
    {
		$entries = json_decode($request->request->get('entries'));
		$nav = $request->request->get('nav');
		$id = $request->request->get('termbaseId');
		
		// $entryController = new EntryController($id);
		// $entries_json = $entryController->getAll();
		// $entries = json_decode($entries_json);
		
		// $termbase = new TermbaseController();
		// $termbase->get($id);
		
		return $this->render(
			'jbox/large.html.twig',
			array('entries'=>$entries, 'e'=>$nav['e'], 'l'=>$nav['l'], 't'=>$nav['t'])
		);
    }
	
	/**
     * @Route("/termbase/entry/view/addNote", name="jbox_addNote")
     */
	public function addNoteAction(Request $request)
	{
		$nav = $request->request->get('nav');
		$id = $request->request->get('termbaseId');
		
		return $this->render(
			'jbox/addNote.html.twig',
			array('entries'=>$entries, 'e'=>$nav['e'], 'l'=>$nav['l'], 't'=>$nav['t'])
		);
	}
}
