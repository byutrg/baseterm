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
use ServiceBundle\Controller\GlobalController;

class EntryController extends Controller
{
	private $api_address;
	private $path;
	private $path_id;
	
	public function __construct($api_address)
	{
		$this->api_address = $api_address;
	}

	public function setPath($termbase_id)
	{
		$this->path = $this->api_address."/termbases/".$termbase_id."/entries";
	}

	
	//Entry Controller
	public function setId($entry_id)
	{
		$this->path_id = $this->path."/".$entry_id;
	}
	
	public function get($entry_id)
	{
		$this->path_id = $this->path."/".$entry_id;
		$apiController = new apiController();
		$result_json = $apiController->get($this->path_id);
		
		return $result_json;
	}
	
	public function getAll()
	{
		$apiController = new apiController();
		$result_json = $apiController->get($this->path);
		
		return $result_json;
	}
	
	public function addEntry($entry)
	{
		$apiController = new apiController();
		$result_json = $apiController->post($this->path,$entry);
		
		return $result_json;
	}
	
	public function updateEntry($entry)
	{
		$apiController = new apiController();
		$result_json = $apiController->put($this->path_id,$entry);
		return $result_json;
	}
	
	public function deleteEntry()
	{
		$apiController = new apiController();
		$result_json = $apiController->delete($this->path_id);
		
		return $result_json;
	}
	//END entry controller
}