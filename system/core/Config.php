<?php
namespace System\Core;
/**
 * Config class
 */
class Config
{
    public static function init()
    {
        global $config;
        /**
         * Set session path
         */
        if($config['session_path'] != null){
            ini_set('session.save_path', $config['session_path']);
        }
        /**
         * Set Default Timezone
         */
        if($config['timezone'] != null){
            date_default_timezone_set($config['timezone']);
        }
        /**
         * Set Default Charset
         */
        if($config['charset'] != null){
            ini_set('default_charset', $config['charset']);
        }
    }
}
