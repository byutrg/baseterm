<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
		return $this->render(
			'default/index.html.twig',
			array()
		);
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
