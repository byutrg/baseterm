<?php
/*
 *  This file is part of BaseTerm.
 *  
 *  BaseTerm is an open-source and free to use terminology management system built with the primary goal of natively supporting the most popular TBX dialect for exchange, TBX-Basic
 *  
 *  Copyright © (2016-2017) BYU TRG & LTAC Global & CRITI
 *  
 *  See the file LICENSE file that accompanied this source code for the full license
 *  information
 */
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
		$ext = '/\.tbx$/';
		$fileName = $this->name;
		if (preg_match($ext, $this->name) == 0)
		{
			$fileName .= ".tbx";
		}

		$result = $this->export();
		// unset($result);
		$tmpName = tempnam(sys_get_temp_dir(), $fileName);
		
		$tbxFile = fopen($tmpName, 'w');
		fwrite($tbxFile, $result);
		fclose($tbxFile);

		header('Content-Description: File Transfer');
		header('Content-Type: text/xml');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Content-Disposition: attachment; filename='.$fileName);
		header('Cache-Control: must-revalidate');
		header('Content-Length: '.filesize($tmpName));
		ob_clean();
		// ob_end_clean();
		flush();
		readfile($tmpName);
		unlink($tmpName);
	}
	//end export
	
}