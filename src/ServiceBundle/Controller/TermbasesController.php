<?php

namespace ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ServiceBundle\Controller\apiController;
use ServiceBundle\Controller\GlobalController;

class TermbasesController extends Controller
{
	private $path;
	
	public function __construct()
	{
		$gobals = new GlobalController();
		$api_address = $gobals->api_address;
		
		$this->path = $api_address."/termbases";
	}
	
	public function getAllAction()
	{
		$apiController = new apiController();
		$result = $apiController->get($this->path);
		
		return $result;
	}
}