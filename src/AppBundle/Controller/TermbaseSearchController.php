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
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ServiceBundle\Controller\TermbaseController;
use ServiceBundle\Controller\TermbasesController;
use ServiceBundle\Controller\EntryController;
use ServiceBundle\Controller\PersonController;
use AppBundle\Entity\Language;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class TermbaseSearchController extends Controller
{
    /**
     * @Route("/termbase/search", name="search_termbase")
     */
    public function searchAction(Request $request)
    {

		$id = $request->request->get('form')['id'];
		if (!isset($id) || $id == "") { $id = $request->query->get('id'); } //use GET if POST is empty
		if (!isset($id) || $id == "") { return $this->redirectToRoute('homepage'); } //redirect of POST and GET are empty
		$name = $request->request->get('name');
		if (!isset($name) || $name == "") { $name = $request->query->get('name'); } //use GET if POST is 
		$response = 'response';

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
		$form = $this->createFormBuilder()
				->add('termbaseId', 'hidden', array('data' => $id))
				->add('addEntry', 'submit', array('label' => 'Add a New Entry'))
				->getForm();
		return $this->render(
			'default/search.html.twig',
			array('id'=>$id, 'newEntryForm'=>$form, 'name'=>$name, 'languages'=>$languages, 'languageDict'=>$languageDict, 'regionDict'=>$regionDict)
		);
    }    
	
	/**
     * @Route("/termbase/search_all", name="search_termbase_all")
     */
    public function searchAllAction(Request $request)
    {
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
        
		return $this->render(
			'default/search_all.html.twig',
            array('languages'=>$languages, 'languageDict'=>$languageDict, 'regionDict'=>$regionDict)
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
		
		$languages = $this->getDoctrine()
				->getRepository('AppBundle:Language')
				->findAll();
        
		$encoders = array(new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers,$encoders);
		$json_languages = $serializer->serialize($languages, 'json');
        
        $regions = $this->getDoctrine()
				->getRepository('AppBundle:Region')
				->findAll();
        
        $regionDict = array();
        foreach ($regions as $region)
		{
			$regionDict[$region->getCode()] = $region->getName();
		}
        
        $regionDict_json = $serializer->serialize($regionDict, 'json');
        
		return $this->render( 
			'default/js/search.js.twig',
			array('entries'=>$entries,'id'=>$id, 'persons'=>$persons, 'languages'=>$json_languages, 'regions'=>$regionDict_json, 'GET'=>$_GET)
		);
	}
	
	/**
     * @Route("/termbase/search_all.js", name="search_termbase_all_js")
     */
	public function scriptAllAction()
	{
		$entries_list = array();
		$entry_termbase_link = array();
		$tc = new TermbasesController();
		$termbases = json_decode($tc->getAllAction());
		
		if (isset($termbases) && count($termbases) > 0)
		{
			foreach ($termbases as $termbase)
			{
				$entryController = new EntryController($termbase->id);
				$entries_json = $entryController->getAll();
				$entries = json_decode($entries_json);
				
				array_push($entries_list,$entries);
				array_push($entry_termbase_link, array(
						'name'=>$termbase->name,
						'id'=>$termbase->id
					));
			}
		}
        
        $languages = $this->getDoctrine()
				->getRepository('AppBundle:Language')
				->findAll();
        
		$encoders = array(new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers,$encoders);
		$json_languages = $serializer->serialize($languages, 'json');
        
        $regions = $this->getDoctrine()
				->getRepository('AppBundle:Region')
				->findAll();
        
        $regionDict = array();
        foreach ($regions as $region)
		{
			$regionDict[$region->getCode()] = $region->getName();
		}
        
        $regionDict_json = $serializer->serialize($regionDict, 'json');
        
		return $this->render( 
			'default/js/search_all.js.twig',
			array('entries_list'=>$entries_list, 'entry_termbase_link'=>$entry_termbase_link, 'languages'=>$json_languages, 'regions'=>$regionDict_json)
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
