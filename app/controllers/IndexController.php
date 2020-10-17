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
		//This is for measuring page speed
		$this->benchmark->mark('start');
		
		$this->load->view("home");

		$this->benchmark->mark('end');
		echo "Page render in ".$this->benchmark->elapsed_time('start', 'end');
	}

	public function te($id = false){
		
		$this->benchmark->mark('start');

		$this->load->view("home.te", [
				'name' => 'BihongoPHP'
			 ]);

		$this->benchmark->mark('end');
		echo "Page render in ".$this->benchmark->elapsed_time('start', 'end');
	}

}
?>