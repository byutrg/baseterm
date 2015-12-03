<?php

namespace ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ServiceBundle\Controller\apiController;
use ServiceBundle\Controller\GlobalController;

class TermbasesController extends Controller
{
	private $path;
	private $api_address;
	
	public function __construct()
	{
		$gobals = new GlobalController();
		$this->api_address = $gobals->api_address;
		
		$this->path = $this->api_address."/termbases";
	}
	
	public function getAllAction()
	{
		$apiController = new apiController();
		$result = $apiController->get($this->path);
		
		return $result;
	}

	public function import($file_path, $name)
	{
		$import_path = $this->api_address."/import";
		
		$post = array(
			'file'=>'@'.$file_path,
			'name'=>$name
		);
		
		$apiController = new apiController();
		$result = $apiController->postFile($import_path, $post);
		return $result;
	}
}