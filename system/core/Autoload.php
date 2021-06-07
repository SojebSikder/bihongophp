<?php

/**
 * Custom Autoload
 */
class Autoload
{
    public static function init()
    {
        //Library
        spl_autoload_register(function ($class) {
            global $system_path;

            if (file_exists($system_path . "/libraries\/" . $class . ".php")) {
                require $system_path . "/libraries\/" . $class . ".php";
            }
        });
        //Helper
        spl_autoload_register(function ($class) {
            global $system_path;
            if (file_exists($system_path . "/helpers\/" . $class . ".php")) {
                require $system_path . "/helpers\/" . $class . ".php";
            }
        });
        /**
         * Autoload User
         */
        //Library
        spl_autoload_register(function ($class) {
            global $application_folder;
            if (file_exists($application_folder . "/libraries\/" . $class . ".php")) {
                require $application_folder . "/libraries\/" . $class . ".php";
            }
        });
        //Helper
        spl_autoload_register(function ($class) {
            global $application_folder;
            if (file_exists($application_folder . "/helpers\/" . $class . ".php")) {
                require $application_folder . "/helpers\/" . $class . ".php";
            }
        });

        //Model
        spl_autoload_register(function ($class) {
            global $application_folder;
            if (file_exists($application_folder . "/models\/" . $class . ".php")) {
                require $application_folder . "/models\/" . $class . ".php";
            }
        });
    }
}
