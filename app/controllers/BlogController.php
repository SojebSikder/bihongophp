<?php 

class BlogController extends Controller{
	public function __construct(){
	 	parent::__construct();
	}

	public function home(){
		 //$this->load->view("blog");
		view("blog");
	}

}
?>