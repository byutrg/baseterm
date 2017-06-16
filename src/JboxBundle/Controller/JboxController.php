<?php
/*
 *  This file is part of BaseTerm.
 *  
 *  BaseTerm is an open-source and free to use terminology management system built with the primary goal of natively supporting the most popular TBX dialect for exchange, TBX-Basic
 *  
 *  Copyright © (2016-2017) BYU TRG & LTAC Global & CRITI
 *  
 *  See the file LICENSE file that accompanied this source code for the full license
 *  information
 */
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
		$search_all = $request->request->get('search_all');
		// $entryController = new EntryController($id);
		// $entries_json = $entryController->getAll();
		// $entries = json_decode($entries_json);
		
		$languages = $this->getDoctrine()
				->getRepository('AppBundle:Language')
				->findAll();
		
		$languageDict = array();
		foreach ($languages as $lang)
		{
			$codes = preg_split("/,/", $lang->getCodes());
			foreach ($codes as $code)
			{
				$languageDict[$code] = $lang->getName();
			}
		}
		
        $regions = $this->getDoctrine()
				->getRepository('AppBundle:Region')
				->findAll();
        
        $regionDict = array();
        foreach ($regions as $region)
		{
			$regionDict[$region->getCode()] = $region->getName();
		}
		
		// $termbase = new TermbaseController();
		// $termbase->get($id);
		if ($search_all == 'false')
		{
			return $this->render(
				'jbox/small.html.twig',
				array('entries'=>$entries, 'languages'=>$languages, 'languageDict'=>$languageDict, 'regionDict'=>$regionDict, 'el'=>'', 'e'=>$nav['e'], 'l'=>$nav['l'], 't'=>$nav['t'], 'search_all' => $search_all)
			);
		}
		else if ($search_all == 'true')
		{
			return $this->render(
				'jbox/small.html.twig',
				array('entries'=>$entries, 'languages'=>$languages, 'languageDict'=>$languageDict, 'regionDict'=>$regionDict, 'el'=>$nav['el'], 'e'=>$nav['e'], 'l'=>$nav['l'], 't'=>$nav['t'], 'search_all' => $search_all)
			);
		}
    }
	
	/**
     * @Route("/termbase/entry/view/large", name="jbox_large")
     */
    public function largeAction(Request $request)
    {
		$entries = json_decode($request->request->get('entries'));
		$nav = $request->request->get('nav');
		$id = $request->request->get('termbaseId');
		$no_edit = $request->request->get('no_edit');
		$search_all = $request->request->get('search_all');
		// $entryController = new EntryController($id);
		// $entries_json = $entryController->getAll();
		// $entries = json_decode($entries_json);
		
		$languages = $this->getDoctrine()
				->getRepository('AppBundle:Language')
				->findAll();
		
		$languageDict = array();
		foreach ($languages as $lang)
		{
			$codes = preg_split("/,/", $lang->getCodes());
			foreach ($codes as $code)
			{
				$languageDict[$code] = $lang->getName();
			}
		}
		
        $regions = $this->getDoctrine()
				->getRepository('AppBundle:Region')
				->findAll();
        
        $regionDict = array();
        foreach ($regions as $region)
		{
			$regionDict[$region->getCode()] = $region->getName();
		}
        
		// $termbase = new TermbaseController();
		// $termbase->get($id);
		if ($search_all == 'false')
		{
			return $this->render(
				'jbox/large.html.twig',
				array('entries'=>$entries, 'languages'=>$languages, 'languageDict'=>$languageDict, 'regionDict'=>$regionDict, 'el'=>'', 'e'=>$nav['e'], 'l'=>$nav['l'], 't'=>$nav['t'], 'no_edit'=> $no_edit, 'search_all' => $search_all)
			);
		}
		else if ($search_all == 'true')
		{
			return $this->render(
				'jbox/large.html.twig',
				array('entries'=>$entries,'languages'=>$languages, 'languageDict'=>$languageDict, 'regionDict'=>$regionDict, 'el'=>$nav['el'], 'e'=>$nav['e'], 'l'=>$nav['l'], 't'=>$nav['t'], 'no_edit'=> $no_edit, 'search_all' => $search_all)
			);
		}
		
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
