<?php

namespace App\Controllers;

use App\Middleware\CheckAge;
use Data;

class IndexController extends Controller
{
	public function __construct()
	{
		parent::__construct();

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

		return json(["data" => $data]);
	}
}
