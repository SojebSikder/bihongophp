<?php

namespace App\Controllers;

use Data;

class IndexController extends Controller
{
	public function __construct()
	{
		parent::__construct();

		//$this->middleware('auth:api')->only(['store', 'update', 'destroy']);
		// $this->registerMiddleware(new CheckAge());
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
		$data = Data::all();
		return $data;
	}
}
