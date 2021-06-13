<?php

namespace App\Controllers;

use App\Middleware\Auth;

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
		//$this->middleware('auth:api');
		// $this->middleware('auth:api')->only(['index']);
		$this->middleware(new Auth());

		echo "<pre>";
		var_dump($this->getMiddleware());
		echo "</pre>";
	}

	/**
	 * Home page
	 */
	public function index()
	{
		return view("home.te");
	}
	public function test()
	{
		return "test";
	}
}
