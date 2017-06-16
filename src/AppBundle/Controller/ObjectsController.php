<?php
/*
 *  This file is part of BaseTerm.
 *  
 *  BaseTerm is an open-source and free to use terminology management system built with the primary goal of natively supporting the most popular TBX dialect for exchange, TBX-Basic
 *  
 *  Copyright © (2015-2017) BYU TRG & LTAC Global & CRITI
 *  
 *  See the LICENSE file that accompanied this source code for the full license
 *  information
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ServiceBundle\Controller\TermbaseController;
use ServiceBundle\Controller\EntryController;

class ObjectsController extends Controller
{
    /**
     * @Route("/objects/entry.js", name="objects_entry")
     */
    public function entryAction()
    {
		return $this->render(
			'objects/entryObject.js.twig'
		);
    }
	
	/**
     * @Route("/objects/person.js", name="objects_person")
     */
    public function personAction()
    {
		return $this->render(
			'objects/personObject.js.twig'
		);
    }
}
