<?php
/**
 * Benchmark Class
 * Mesuring Profiling
 */

class Benchmark
{
	public $marker = array();

    public function mark($name)
	{
		$this->marker[$name] = microtime(TRUE);
    }
    
    public function elapsed_time($point1 = '', $point2 = '', $decimals = 4)
	{
		return number_format($this->marker[$point2] - $this->marker[$point1], $decimals);
    }

}


