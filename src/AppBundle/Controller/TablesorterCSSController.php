<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TablesorterCSSController extends Controller
{
    /**
     * @Route("/css/asc.gif", name="tablesorter_asc")
     */
    public function ascAction()
    {
		return $this->render('@AppBundle/Resources/js/jquery_plugins/tablesorter/themes/blue/asc.gif'
		);
    }
	/**
	* @Route("/css/desc.gif", name="tablesorter_desc")
	*/
    public function descAction()
    {
		return $this->render('@AppBundle/Resources/js/jquery_plugins/tablesorter/themes/blue/desc.gif'
		);
    }
	/**
	* @Route("/css/bg.gif", name="tablesorter_bg")
	*/
    public function bgAction()
    {
		return $this->render('@AppBundle/Resources/js/jquery_plugins/tablesorter/themes/blue/bg.gif'
		);
    }
}
