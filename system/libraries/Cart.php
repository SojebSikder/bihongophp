<?php
class Cart
{
    public function insert($data){
        if(is_array($data)){
            foreach ($data as $cartData => $cartValue) {
                echo $cartData.":".$cartValue."<br>";
            }
        }
    }
}



?>