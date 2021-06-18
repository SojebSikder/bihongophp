<?php


namespace System\Core;

use System\Helpers\ArrayHelper;

/**
 * Class Response
 */
class Response
{
    public function __construct($content = false, $statusCode = false)
    {
        if ($statusCode) {
            http_response_code($statusCode);
        }
        if ($content) {
            return $content;
        } else {
            return $this;
        }
    }

    public function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        return ArrayHelper::json($data);
    }
    public function statusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect($url)
    {
        header("Location: $url");
    }
}
