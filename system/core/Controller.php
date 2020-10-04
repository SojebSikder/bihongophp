<?php
/*
* Main Controller
*/
class Controller{
    protected $load = array();
    protected $input = array();
    protected $benchmark = array();

    public function __construct(){
        $this->load = new Load();
        $this->input = new Input();
        $this->benchmark = new Benchmark();
    }
}


?>