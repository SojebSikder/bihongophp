<?php 
/**
 * Home page for this controller
 * home method call autometically if method not set on route
 * 
 * It recommended to use parameter upto 2. Also will be help on SEO
 */
class IndexController extends Controller{
	public function __construct(){
		parent::__construct();
	}

	public function home(){
		$this->load->view("home");
	}

	public function blade(){
		$this->benchmark->mark('start');

		$this->load->view("home.blade");

		$this->benchmark->mark('end');
		echo "Page render in ".$this->benchmark->elapsed_time('start', 'end');
	}
}
?>