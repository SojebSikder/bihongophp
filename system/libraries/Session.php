<?php

namespace System\Libraries;

/**
 * Session Class
 */

class Session
{
    public static function getInstance()
    {
        return new static;
    }

    public static function init()
    {
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if (session_id() == '') {
                session_start();
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key, $default = null)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            if (is_null($default)) {
                return false;
            } else {
                return $default;
            }
        }
    }

    public static function checkSession($name)
    {
        self::init();
        if (self::get($name) == false) {
            self::destroy();
        }
    }


    public static function destroy()
    {
        self::init();
        session_destroy();
    }
}
