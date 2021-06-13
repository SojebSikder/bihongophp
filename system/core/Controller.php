<?php
namespace System\Core;
/*
* Main Controller
*/
class Controller
{
    public $load = array();
    public $input = array();
    public $benchmark = array();

    public function __construct()
    {
        $this->load = new Load();
        $this->input = new Input();
        $this->benchmark = new Benchmark();
    }
}
