<?php
if (!function_exists('json')) {

    /**
     * array to json directory
     */
    function json($data)
    {
        return ArrayHelper::json($data);
    }
}

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
