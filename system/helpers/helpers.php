<?php


/**
 * Data
 */
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
