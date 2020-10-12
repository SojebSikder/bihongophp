<?php
/**
 * Form Helper
 */

if (!function_exists('form_open'))
{
    function form_open($action = '', $attributes = array(), $hidden = array())
    {
        global $config;
        if($config['csrf_protection'] == FALSE){

            $attr = '';
            foreach ($attributes as $attribute => $value) {
                $attr .= $attribute."= ".$value."  ";
            }
            $form = '<form '.$attr.' action="'.ROOT.$action.'"'.">\n";
            return $form;
        }
        else{
            /**
             * CSRF Protection
             */
            //session_start();
            $tokenName = $config['csrf_token_name'];
            if(empty($_SESSION[$tokenName])){
                $_SESSION[$tokenName] = bin2hex(random_bytes(32));
            }
            $token = $_SESSION[$tokenName];
            //End that

            $attr = '';
            foreach ($attributes as $attribute => $value) {
                $attr .= $attribute."= ".$value."  ";
            }
            
            $form = '<form '.$attr.' action="'.ROOT.$action.'"'.">\n";
            $form .= '<input name='.$tokenName.' type="hidden" value="'.$token.'">';
            return $form;
        }
    }
}


if (!function_exists('form_open_multipart'))
{
    function form_open_multipart($action = '', $attributes = array(), $hidden = array())
    {
        global $config;
        if($config['csrf_protection'] == FALSE){

            $attr = '';
            foreach ($attributes as $attribute => $value) {
                $attr .= $attribute."= ".$value."  ";
            }
            $form = '<form '.$attr.' enctype="multipart/form-data" action="'.ROOT.$action.'"'.">\n";
            return $form;
        }
        else{
            /**
             * CSRF Protection
             */
            //session_start();
            $tokenName = $config['csrf_token_name'];
            if(empty($_SESSION[$tokenName])){
                $_SESSION[$tokenName] = bin2hex(random_bytes(32));
            }
            $token = $_SESSION[$tokenName];
            //End that

            $attr = '';
            foreach ($attributes as $attribute => $value) {
                $attr .= $attribute."= ".$value."  ";
            }
            
            $form = '<form '.$attr.' enctype="multipart/form-data" action="'.ROOT.$action.'"'.">\n";
            $form .= '<input name='.$tokenName.' type="hidden" value="'.$token.'">';
            return $form;
        }
    }

}

if (!function_exists('form_close'))
{
    function form_close()
    {
        return "</form>";
    }
}


?>