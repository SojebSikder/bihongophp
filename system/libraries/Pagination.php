<?php
/**
 * Pagination Library
 */
class Pagination
{
    public $base_url;
    public $total_rows;
    public $per_page;

    public function init($config){
        $this->base_url = $config['base_url'];
        $this->total_rows = $config['total_rows'];
        $this->per_page = $config['per_page'];
    }

    public function createLink()
    {
        // adding limits to select query
        //$total = $this->total_rows;
        //$limit =  $this->per_page;
        
        $number_page = (int) ceil($this->total_rows / $this->per_page)+1;

        $el = '';
        for ($i=1; $i < $number_page; $i++) { 
            $el = $el.'<a href="'.$this->base_url.number_format($i*$this->per_page).'">'.$i.'</a>';
        }
        return $el;
    }

    public function getAllRecords()
    {
        $query = 'SELECT * FROM tbl_animal';
        $totalRecords = $this->ds->getRecordCount($query);
        return $totalRecords;
    }

}

?>