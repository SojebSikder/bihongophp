<?php
/**
 * Form Helper
 */

if (!function_exists('form_open'))
{
    function form_open($action = '', $attributes = array(), $hidden = array())
    {
        $attr = '';
        foreach ($attributes as $attribute => $value) {

          /*  if (stripos($attribute, 'method') === FALSE)
            {
                $attribute .= ' method';
            } */
            $attr .= $attribute."= ".$value."  ";
        }
        
        $form = '<form '.$attr.' action="'.ROOT.$action.'"'.">\n";
        return $form;
    }
}


if (!function_exists('form_open_multipart'))
{
    function form_open_multipart($action = '', $attributes = array(), $hidden = array())
    {
        $attr = '';
        foreach ($attributes as $attribute => $value) {
            $attr .= $attribute."= ".$value."  ";
        }
        
        $form = '<form '.$attr.' enctype="multipart/form-data" action="'.ROOT.$action.'"'.">\n";
        return $form;

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