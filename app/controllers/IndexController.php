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

		//echo getenv('APP_ENV');
		//echo DotEnv::get('APP_NAME', 'sojeb sikder');

		echo env('APP_NAME', 'sojeb sikder');

		$this->load->view("home.te", [
			'name' => 'BihongoPHP'
		]);
	}
}
