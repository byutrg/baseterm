<?php

namespace ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ServiceBundle\Controller\apiController;
use ServiceBundle\Controller\GlobalController;

class EntryController extends Controller
{
	private $path;
	private $path_id;
	
	public function __construct($termbase_id)
	{
		$gobals = new GlobalController();
		$api_address = $gobals->api_address;
		
		$this->path = $api_address."/termbases/".$termbase_id."/entries";
	}

	
	//Entry Controller
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
		$entry->clean();
		$apiController = new apiController();
		$result_json = $apiController->post($this->path, json_encode($entry));
		
		return $result_json;
	}
	
	public function updateEntry($entry)
	{
		$apiController = new apiController();
		$result_json = $apiController->put($this->path_id, $entry);
		
		return $result_json;
	}
	
	public function deleteEntry($entryId)
	{
		$apiController = new apiController();
		$result_json = $apiController->delete($this->path_id);
		
		return $result_json;
	}
	//END entry controller
}