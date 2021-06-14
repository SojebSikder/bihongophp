<?php

namespace System\Core;


/**
 * Class Request
 *
 */
class Request
{


    // For users use
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

    public function input($url)
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
    // end




    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getUrl()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    public function isGet()
    {
        return $this->getMethod() === 'get';
    }

    public function isPost()
    {
        return $this->getMethod() === 'post';
    }

    public function getBody()
    {
        $data = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $data;
    }
}
