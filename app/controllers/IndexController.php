<?php

/**
 * Home page for this controller
 * home method call autometically if method not set on route
 * 
 * It recommended to use parameter upto 2. Also will be help on SEO
 */
class IndexController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}


	public function home($id = false)
	{
		$this->load->view("home.te", [
			'name' => 'BihongoPHP'
		]);
	}
}
