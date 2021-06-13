<?php

namespace App\Controllers;

use App\Middleware\Auth;
use App\Middleware\CheckAge;
use System\Core\Request;

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
		$this->registerMiddleware(new CheckAge);

		echo "<pre>";
		var_dump($this->getMiddleware());
		echo "</pre>";
	}

	/**
	 * Home page
	 */
	public function index(Request $request)
	{
		echo $request->get('age');
		return view("home.te");
	}
	public function test()
	{
		return "test";
	}
}
