<?php

namespace ServiceBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class apiController extends Controller
{		
	public function get($path)
	{
		$ch = curl_init();

		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $path
		));
				
		$result = curl_exec($ch);
		return $result;
	}

	public function post($path, $post) //takes API path and post data array
	{
		$ch = curl_init();
		
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => 1,
			//CURLOPT_HTTPHEADER => array('Content-Type: application/json'), //x-www-form-urlencoded
			CURLOPT_URL => $path,
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $post
		));
	
		$result = curl_exec($ch);
		
		return $result;
	}
	
	public function put($path, $data) //API path, put data array
	{
		$ch = curl_init();
		
		curl_setopt_array($ch, array(
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_HTTPHEADER => array('Content-Type: application/json'), //x-www-form-urlencoded
				CURLOPT_URL => $path,
				CURLOPT_CUSTOMREQUEST => "PUT",
				CURLOPT_POSTFIELDS => json_encode($data)
			));
		
		$result = curl_exec($ch);
		
		return $result;
	}
	
	public function delete($path)
	{
		$ch = curl_init();
		
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $path,
			CURLOPT_CUSTOMREQUEST => 'DELETE'
		));
				
		$result = curl_exec($ch);
		
		return $result;
	}
}