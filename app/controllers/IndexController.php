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


	public function home()
	{
		//$data = DB::select("select * from addresses");
		$data = DB::selectOne("select * from addresses");
		echo json_encode($data);
		$this->load->view("home.te");
	}
}
