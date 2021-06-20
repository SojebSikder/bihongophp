<?php


/**
 * Helpers
 */

use System\Core\Config;
use System\Core\DotEnv;
use System\Core\Lang;
use System\Core\Load;
use System\Core\Response;
use System\Helpers\ArrayHelper;
use System\Helpers\Format;
use System\Helpers\Security;
use System\Helpers\Url;
use System\Libraries\Session;

if (!function_exists('response')) {

    /**
     * Load View
     */
    function response($content = false, $statusCode = false)
    {
        $response = new Response();
        return $response->__construct($content, $statusCode);
    }
}

if (!function_exists('session')) {

    /**
     * Get Session
     */
    function session($key = null, $value = null)
    {
        if (is_null($value)) {
            return Session::get($key);
        }
        if (!is_null($key)) {
            return Session::set($key, $value);
        } else {
            return Session::getInstance();
        }
    }
}

if (!function_exists('config')) {

    /**
     * Get Config
     */
    function config($key, $default = null)
    {
        return Config::get($key, $default);
    }
}

if (!function_exists('trans')) {

    /**
     * Load View
     */
    function trans($key)
    {
        return Lang::trans($key);
    }
}

if (!function_exists('setLocal')) {

    /**
     * Set Locale
     */
    function setLocal($langname)
    {
        return Lang::setLocale($langname);
    }
}

if (!function_exists('view')) {

    /**
     * Load View
     */
    function view($filename, $data = false)
    {
        $load = new Load();
        return $load->view($filename, $data);
    }
}

if (!function_exists('model')) {

    /**
     * Load Model
     */
    function model($modelname)
    {
        $load = new Load();
        return $load->model($modelname);
    }
}

if (!function_exists('helper')) {

    /**
     * Load Helper
     */
    function helper($helpername)
    {
        $load = new Load();
        return $load->helper($helpername);
    }
}

if (!function_exists('library')) {

    /**
     * Load Library
     */
    function library($libraryname)
    {
        $load = new Load();
        return $load->library($libraryname);
    }
}

/**
 * Security
 */
if (!function_exists('xss')) {
    /**
     * Clean data
     */
    function xss($string, $allow = null)
    {
        return Security::xss($string, $allow);
    }
}


if (!function_exists('bcrypt')) {
    /**
     * Hash the given value against the bcrypt algorithm.
     *
     * @param  string  $value
     * @param  array  $options
     * @return string
     */
    function bcrypt($value, $options = ['PASSWORD_DEFAULT'])
    {
        return Format::bcrypt($value, $options);
    }
}

if (!function_exists('verify')) {
    /**
     * Verify bcrypt hash
     */
    function verify($value, $hash)
    {
        return Format::verify($value, $hash);
    }
}

if (!function_exists('json')) {

    /**
     * array to json directory
     */
    function json($data)
    {
        return ArrayHelper::json($data);
    }
}


/**
 * Url
 */

if (!function_exists('asset')) {

    /**
     * Get asset directory
     */
    function asset($url)
    {
        return Url::asset($url);
    }
}

if (!function_exists('resource')) {

    /**
     * get resource directory
     */
    function resource($url)
    {
        return Url::resource($url);
    }
}

/**
 * Env
 */
if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        return DotEnv::get($key, $default);
    }
}
