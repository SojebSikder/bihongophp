<?php 
/**
 * Home page for this controller
 * home method call autometically if method not set on route
 */
class IndexController extends Controller{
	public function __construct(){
		parent::__construct();
	}

	public function home(){
		$this->load->view("home");
	}
}
?>