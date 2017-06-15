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

class GlobalController extends Controller
{
	public $api_address;
	
	public function __construct()
	{
		$this->api_address = 'localhost:6543';
	}
}