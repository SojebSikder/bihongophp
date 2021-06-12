<?php

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


	public function home()
	{
		//echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		return view("home.te");
	}
	public function test()
	{
		echo "test";
	}
}
