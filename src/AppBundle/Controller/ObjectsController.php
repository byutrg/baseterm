<?php

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
