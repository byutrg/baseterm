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
