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
		//$data = User::all();
		//echo $data;
		$data = DB::select("select * from users");
		echo json_encode($data);
		$this->load->view("home.te");
	}
}
