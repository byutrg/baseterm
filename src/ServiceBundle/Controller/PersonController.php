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

class PersonController extends Controller
{
	private $api_adress;
	private $path;
	
	public function __construct($api_address)
	{
		$this->api_address = $api_address;
	}
	
	public function setPath($termbase_id)
	{
		$this->path = $this->api_address."/termbases/".$termbase_id."/people";
	}

	//Person Controller
	public function getAll()
	{
		
		$apiController = new apiController();
		$result = $apiController->get($this->path);
		
		return $result;
	}
	
	public function getPerson($id)
	{
		$apiController = new apiController();
		$result = $apiController->get($this->path+'/'+$id);
		
		return $result;
	}
	
	public function postPerson($person) //person object
	{
		$data = array(
			'id' => '', //just gets overwritten
			'email'=> $person['email'],
			'fn'=> $person['fn'],
			'role'=> $person['role']
		);

		$apiController = new apiController();
		$result = $apiController->post($this->path, $data);
		var_dump($result);die;
		return $result;
	}
	
	public function updatePerson($person)
	{
		$peoplePath = $this->path."/".$person->id;
		
		$data = array(
			'id'=> $person->id,
			'email'=> $person->email,
			'fn'=> $person->fn,
			'role'=> $person->role
		);
		
		$apiController = new apiController();
		$result = $apiController->put($peoplePath, $data);
		
		return $result;
		
	}
	
	public function deletePerson($person)
	{
		$peoplePath = $this->path."/".$person->id;
		
		$apiController = new apiController();
		$result = $apiController->delete($peoplePath);
		
		return $result;
	}
	//END Person controller	
}