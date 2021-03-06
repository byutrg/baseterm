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

	public function post($path, $data) //takes API path and post data array
	{
		$ch = curl_init();
        
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_HTTPHEADER => array('Content-Type: application/json'), //x-www-form-urlencoded
			CURLOPT_URL => $path,
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => json_encode($data)
		));
	
		$result = curl_exec($ch);

		return $result;
	}
	
	public function postFile($path, $data) //same as post, but no json_encode(data)
	{
		$ch = curl_init();

		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $path,
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_SAFE_UPLOAD, true
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