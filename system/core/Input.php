<?php
namespace System\Core;
/**
 * Input Class
 */
class Input
{
    public function post($url)
    {
        global $config;

        if ($config['csrf_protection'] == FALSE) {
            if (isset($_POST[$url])) {
                return $_POST[$url];
            }
        } else {

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            } else {
            }
            //session_start();

            if (!empty($_POST[$config['csrf_token_name']])) {
                if (hash_equals($_SESSION[$config['csrf_token_name']], $_POST[$config['csrf_token_name']])) {
                    if (isset($_POST[$url])) {
                        return $_POST[$url];
                    }
                }
            }
        }
    }

    public function get($url)
    {
        global $config;

        if ($config['csrf_protection'] == FALSE) {
            if (isset($_GET[$url])) {
                return $_GET[$url];
            }
        } else {

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            } else {
            }
            //session_start();

            if (!empty($_GET[$config['csrf_token_name']])) {
                if (hash_equals($_SESSION[$config['csrf_token_name']], $_GET[$config['csrf_token_name']])) {
                    if (isset($_GET[$url])) {
                        return $_GET[$url];
                    }
                }
            }
        }
    }

    public function request($url)
    {
        global $config;
        if ($config['csrf_protection'] == FALSE) {
            if (isset($_REQUEST[$url])) {
                return $_REQUEST[$url];
            }
        } else {

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            } else {
            }
            //session_start();

            if (!empty($_REQUEST[$config['csrf_token_name']])) {
                if (hash_equals($_SESSION[$config['csrf_token_name']], $_REQUEST[$config['csrf_token_name']])) {
                    if (isset($_REQUEST[$url])) {
                        return $_REQUEST[$url];
                    }
                }
            }
        }
    }
}
