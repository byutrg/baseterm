<?php

namespace ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GlobalController extends Controller
{
	public $api_address;
	
	public function __construct()
	{
		$this->api_address = 'localhost:6543';
	}
}