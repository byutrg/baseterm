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

class DefaultController extends Controller
{
	private function browser_name()
	{
		$ua = $_SERVER['HTTP_USER_AGENT'];

		if (
			strpos(strtolower($ua), 'safari/') &&
			strpos(strtolower($ua), 'opr/')
		) {
			// Opera
			$res = 'Opera';
		} elseif (
			strpos(strtolower($ua), 'safari/') &&
			strpos(strtolower($ua), 'chrome/')
		) {
			// Chrome
			$res = 'Chrome';
		} elseif (
			strpos(strtolower($ua), 'msie') ||
			strpos(strtolower($ua), 'trident/')
		) {
			// Internet Explorer
			$res = 'Internet Explorer';
		} elseif (strpos(strtolower($ua), 'firefox/')) {
			// Firefox
			$res = 'Firefox';
		} elseif (
			strpos(strtolower($ua), 'safari/') &&
			(strpos(strtolower($ua), 'opr/') === false) &&
			(strpos(strtolower($ua), 'chrome/') === false)
		) {
			// Safari
			$res = 'Safari';
		} else {
			// Out of data
			$res = false;
		}

		return $res;
	}
	
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
		if ($this->get('security.context')->isGranted('ROLE_STAFF')) {
			
			$user_name = $this->get('security.context')->getToken()->getUser()->getUsername();
			$browser_name = $this->browser_name();
			
			$logger = $this->get('app.logger');
			
			$logger->info("User: ".$user_name." - ".$browser_name." - ".date("Y-m-d G:i:s T"));
			
			return $this->render(
				'default/index.html.twig',
				array()
			);
		}
		else
		{
			return $this->redirectToRoute('search_termbase_all');
		}
		
    }

	/**
     * @Route("/userCheck", name="user_check")
     */
    public function userCheckAction(Request $request)
    {
		if($request->request->get('username') == 'Guest')
		{
			
			return $this->redirectToRoute('termbase_list');
		}
		else return $this->redirectToRoute('homepage');
    }
	
	/**
     * @Route("/termbase", name="termbase_list")
     */
    public function termbaseAction(Request $request)
    {
		if (!$this->get('security.context')->isGranted('ROLE_STAFF'))
		{
			return $this->redirectToRoute('search_termbase_all');
		}
		
		$form = $this->createFormBuilder()
				->getForm();
		
		return $this->render(
			'default/termbaselist.html.twig',
			array('form'=>$form)
		);
    }
	
	/*
	 * @Route("plus.png", name="plus_image")
	 */
	public function plusImageAction(Request $request)
	{
		return $this->render(
			'@AppBundle\Resources\Images\plus_16.png'
		);
	}
}
