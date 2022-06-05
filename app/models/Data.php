<?php

use System\Core\ORM;

class Data extends ORM
{

    public $title;

    public $text;

    public function __construct()
    {
        parent::__construct();
    }
}
