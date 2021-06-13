<?php
namespace System\Libraries;
/**
 * Pagination Library
 */
class Pagination
{
    public static $base_url;
    public static $total_rows;
    public static $per_page;

    public static function init($config){
        self::$base_url = $config['base_url'];
        self::$total_rows = $config['total_rows'];
        self::$per_page = $config['per_page'];
    }

    public static function createLink()
    {
        // adding limits to select query
        //$total = $this->total_rows;
        //$limit =  $this->per_page;
        
        $number_page = (int) ceil(self::$total_rows / self::$per_page)+1;

        $el = '';
        for ($i=1; $i < $number_page; $i++) { 
            $el = $el.'<a href="'.self::$base_url.number_format($i*self::$per_page).'">'.$i.'</a>';
        }
        return $el;
    }


}

?>