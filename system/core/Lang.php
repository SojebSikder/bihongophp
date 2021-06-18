<?php
namespace System\Core;
/**
 * Lang Class - Used for Localization
 */
class Lang
{
    public static $langName;

    /**
     * Set locale language
     */
    public static function setLocale($langName){
        self::$langName = $langName;
    }

    /**
     * Get locale language value
     */
    public static function trans($key){
        global $config;

        if(self::$langName == null){
            self::$langName = $config['locale'];
        }

        if(file_exists($config['url']['resource']."/lang/".self::$langName.".php")){
            require $config['url']['resource']."/lang/".self::$langName.".php";
            if(array_key_exists($key, $lang)){
                return $lang[$key];
            }else{
                show_error($key.' not exist');
            }
            
        }else{
            show_error('language: '.self::$langName.' not found');
        }
    }

}
