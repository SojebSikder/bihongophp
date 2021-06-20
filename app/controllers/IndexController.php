<?php

namespace App\Controllers;

use System\Core\Request;
use System\Libraries\Session;

/**
 * Home page for this controller
 * home method call autometically if method not set on route
 * 
 * It recommended to use parameter upto 2.
 */
class IndexController extends Controller
{
	public function __construct()
	{
		parent::__construct();

		//$this->middleware('auth:api')->only(['store', 'update', 'destroy']);
		//$this->registerMiddleware(new CheckAge);
	}

	/**
	 * Home page
	 */
	public function index()
	{
		echo config('name');
		return view("home.te");
	}
	public function test()
	{
		return "test";
	}
}
