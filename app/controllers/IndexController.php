<?php 
/**
 * Home page for this controller
 * home method call autometically if method not set on route
 * 
 * It recommended to use pareametar upto 2. Also will be help on SEO
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