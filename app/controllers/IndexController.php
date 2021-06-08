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
		$data = Address::where('name', 'sikdersojeb')
			->orWhere('id', 3)->get();

			$data = Address::all();

		$data = json(['data' => $data]);
		echo $data;
		
		return view("home.te");
	}
}
