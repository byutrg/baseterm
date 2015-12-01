<?php

namespace ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGenerator;
use ServiceBundle\Controller\apiController;
use ServiceBundle\Controller\GlobalController;

class TermbaseController extends Controller
{
	private $path;
	private $path_id;
	private $path_export;
	public $working_language;
	public $baseId;
	public $name;
	
	public function __construct()
	{
		$gobals = new GlobalController();
		$api_address = $gobals->api_address;
		
		$this->path = $api_address."/termbases";
	}
	
	//termbaseController
	public function get($id) //fetch object info
	{
		$this->baseId = $id;
		$this->path_id = $this->path."/".$this->baseId;
		$this->path_export = $this->path_id."/export";
		
		$apiController = new apiController();
		$result_json = $apiController->get($this->path_id);
		$result = json_decode($result_json);
		
		$this->working_language = $result->working_language;
		$this->name = $result->name;
	}
	
	public function create($working_language, $name) //post
	{
		$this->working_language = $working_language;

		$this->name = $name;

		$data = array(
			'working_language'=>$this->working_language,
			'name'=>$this->name
		);
		
		$apiController = new apiController();
		$result_json = $apiController->post($this->path, $data);
		$result = json_decode($result_json);

		$this->baseId = $result->created;
		$this->path_id = $this->path."/termbases/".$result->created;
		$this->path_export = $this->path_id."/export";
		
		return $result_json;
	}
	
	public function update()
	{
		$data = array(
			'working_language'=>$this->working_language,
			'name'=>$this->name
		);
		
		$apiController = new apiController();
		$result_json = $apiController->put($this->path_id, $data);
		
		return $result_json;
	}
	
	public function delete()
	{
		$apiController = new apiController();
		$result_json = $apiController->delete($this->path_id);
		
		return $result_json;
	}
	//end termbase controller
	
	//export
	public function export() //returns xml string
	{
		$apiController = new apiController();
		$result = $apiController->get($this->path_export);
		
		return $result;
	}
	
	public function exportToFile() //returns temp file name for download, is not perfect
	{
		$result = $this->export();
		
		$tmpName = tempnam(sys_get_temp_dir(), $this->name);
		$tbxFile = fopen($tmpName, 'w');
		
		fwrite($tbxFile, $result);
		
		header('Content-Description: File Transfer');
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename='.$termbase->name);
		header('Cache-Control: must-revalidate');
		header('Content-Length: '.filesize($tmpName));
		
		ob_clean();
		flush();
		readfile($tmpName);
		
		unlink($tmpName);
		
		return $result;
	}
	//end export
	
}