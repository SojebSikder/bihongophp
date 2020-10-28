<?php 

class AdminController extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function home(){
        echo "home-page<br>";
    }

    public function test($id){
        echo "test-page<br>".$id;
    }

    public function login(){
        echo "login-page<br>";
    }
}

