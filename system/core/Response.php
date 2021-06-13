<?php


namespace System\Core;

use System\Helpers\ArrayHelper;

/**
 * Class Response
 */
class Response
{

    public function json($data)
    {
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
