<?php

/**
 * Form Helper
 */
class Form
{
    public static function open($action = '', $attributes = array(), $hidden = array())
    {
        global $config;
        if ($config['csrf_protection'] == FALSE) {

            $attr = '';
            foreach ($attributes as $attribute => $value) {
                $attr .= $attribute . "= " . "'" . $value . "'" . "  ";
            }
            $form = '<form ' . $attr . ' action="' . ROOT . $action . '"' . ">\n";
            return $form;
        } else {
            /**
             * CSRF Protection
             */
            //session_start();
            $tokenName = $config['csrf_token_name'];
            if (empty($_SESSION[$tokenName])) {
                $_SESSION[$tokenName] = bin2hex(random_bytes(32));
            }
            $token = $_SESSION[$tokenName];
            //End that

            $attr = '';
            foreach ($attributes as $attribute => $value) {
                $attr .= $attribute . "= " . "'" . $value . "'" . "  ";
            }

            $form = '<form ' . $attr . ' action="' . ROOT . $action . '"' . ">\n";
            $form .= '<input name=' . $tokenName . ' type="hidden" value="' . $token . '">';
            return $form;
        }
    }


    public static function open_multipart($action = '', $attributes = array(), $hidden = array())
    {
        global $config;
        if ($config['csrf_protection'] == FALSE) {

            $attr = '';
            foreach ($attributes as $attribute => $value) {
                $attr .= $attribute . "= " . "'" . $value . "'" . "  ";
            }
            $form = '<form ' . $attr . ' enctype="multipart/form-data" method="post" accept-charset="utf-8" action="' . ROOT . $action . '"' . ">\n";
            return $form;
        } else {
            /**
             * CSRF Protection
             */
            //session_start();
            $tokenName = $config['csrf_token_name'];
            if (empty($_SESSION[$tokenName])) {
                $_SESSION[$tokenName] = bin2hex(random_bytes(32));
            }
            $token = $_SESSION[$tokenName];
            //End that

            $attr = '';
            foreach ($attributes as $attribute => $value) {
                $attr .= $attribute . "= " . "'" . $value . "'" . "  ";
            }

            $form = '<form ' . $attr . ' enctype="multipart/form-data" method="post" accept-charset="utf-8" action="' . ROOT . $action . '"' . ">\n";
            $form .= '<input name=' . $tokenName . ' type="hidden" value="' . $token . '">';
            return $form;
        }
    }


    public static function close()
    {
        return "</form>";
    }
}
