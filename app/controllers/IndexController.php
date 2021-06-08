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
		$data = Address::all();

		echo json(['data' => $data]);

		return view("home.te");
	}
}
