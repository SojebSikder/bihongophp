<?php

namespace System\Core;

/**
 * Custom Autoload
 */
class Autoload
{
    static $ext = "../";
    public static function init()
    {
        //Library
        spl_autoload_register(function ($class) {
            global $system_path;

            if (file_exists(self::$ext . $system_path . "/libraries\/" . $class . ".php")) {
                require self::$ext . $system_path . "/libraries\/" . $class . ".php";
            }
        });
        //Helper
        spl_autoload_register(function ($class) {
            global $system_path;
            if (file_exists(self::$ext . $system_path . "/helpers\/" . $class . ".php")) {
                require self::$ext . $system_path . "/helpers\/" . $class . ".php";
            }
        });
        /**
         * Autoload User
         */
        //Library
        spl_autoload_register(function ($class) {
            global $application_folder;
            if (file_exists(self::$ext . $application_folder . "/libraries\/" . $class . ".php")) {
                require self::$ext . $application_folder . "/libraries\/" . $class . ".php";
            }
        });
        //Helper
        spl_autoload_register(function ($class) {
            global $application_folder;
            if (file_exists(self::$ext . $application_folder . "/helpers\/" . $class . ".php")) {
                require self::$ext . $application_folder . "/helpers\/" . $class . ".php";
            }
        });

        //Model
        spl_autoload_register(function ($class) {
            global $application_folder;
            if (file_exists(self::$ext . $application_folder . "/models\/" . $class . ".php")) {
                require self::$ext . $application_folder . "/models\/" . $class . ".php";
            }
        });
    }
}
