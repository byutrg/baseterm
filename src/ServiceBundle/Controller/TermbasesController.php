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
namespace ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ServiceBundle\Controller\apiController;

class TermbasesController extends Controller
{
	private $path;
	private $api_address;
	
	public function __construct($api_address)
	{
		$this->api_address = $api_address;
		$this->path = $api_address."/termbases";
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
		
		if (version_compare(phpversion(), '5.5', '<')) {
			$post = array(
				'file'=> '@'.$file_path,
				'name'=>$name
			);
		}
		else
		{
			$post = array(
				'file'=> new \CURLFile($file_path),
				'name'=>$name
			);
		}

		$apiController = new apiController();
		$result = $apiController->postFile($import_path, $post);
		return $result;
	}
}