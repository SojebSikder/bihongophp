<?php

namespace App\Controllers;

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
	}


	public function index()
	{
		return view("home.te");
	}
	public function test()
	{
		return "test";
	}
}
