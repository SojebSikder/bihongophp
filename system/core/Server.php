<?php
namespace System\Core;
/**
 * Server config class
 */
class Server
{

    public static function init()
    {


        if (file_exists("storage/down")) {
            $server_meta = json_decode(file_get_contents('storage/down'), true);

            //Access only Allowed Ip address
            if (isset($server_meta['allowed'])) {
                //self::allow_ip((array)$server_meta['allowed']);
                $ip = $_SERVER['REMOTE_ADDR'];
                $ip_list = (array)$server_meta['allowed'];

                if (isset($ip)) {
                    if (in_array($ip, $ip_list)) {
                        //echo "allowed";
                        //Router::init();
                        Route::resolve();
                    } else {
                        header("HTTP/1.1 503 Service Temporarily Unavailable");
                        header("Status: 503 Service Temporarily Unavailable");
                        if (isset($server_meta['retry'])) {
                            header('Retry-After: ' . $server_meta['retry']);
                        }
                        if (isset($server_meta['message'])) {
                            echo $server_meta['message'];
                        } else {
                            echo '<title>Service Unavailable</title>
                            <h3>Service Unavailable</h3>';
                        }
                    }
                }
            } else {
                header("HTTP/1.1 503 Service Temporarily Unavailable");
                header("Status: 503 Service Temporarily Unavailable");
                if (isset($server_meta['retry'])) {
                    header('Retry-After: ' . $server_meta['retry']);
                }
                if (isset($server_meta['message'])) {
                    echo $server_meta['message'];
                } else {
                    echo '<title>Service Unavailable</title>
                    <h3>Service Unavailable</h3>';
                }
            }
        } else {
            //Initialize Router
            //Router::init();
            Route::resolve();
        }
    }
}
