<?php

namespace System\Core;

/**
 * Command Class
 */

use System\AppCommand;
use System\Core\Autoload;

require "vendor/autoload.php";
Autoload::init();


class Command
{
    public static $customCmd;
    public static $customCmdArray = array();
    public static $description = array();
    public static $usage = array();
    public static $_instance = null;

    /**
     * Command Promt Color
     */
    public static $red = "\033[31m";
    public static $green = "\033[32m";
    public static $yellow = "\033[33m";
    public static $blue = "\033[34m";
    public static $white = "\033[37m";


    /**
     * Accass Command Prompt Arguments
     */
    public static function args($args)
    {
        global $argc, $argv, $application_folder;
        if (isset($argv[$args])) {
            return $argv[$args];
        } else {
            self::danger($args . " no. argument not found");
        }
    }
    /**
     * Execute an external program
     */
    public static function exec($command, $output = true)
    {
        if ($output == true) {
            return shell_exec($command);
        } else if ($output == false) {
            return exec($command);
        }
        return self::$_instance; //$this;
    }

    /**
     * Set Custom Commands
     */
    public static function set($command, $callback)
    {
        global $argc, $argv, $application_folder;
        self::$customCmd = $command;

        self::$customCmdArray[self::$customCmd] = self::$customCmd;

        if (self::$customCmdArray[self::$customCmd] == $argv[1]) {
            $callback();
        }


        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance; //new static;
    }

    /**
     * Describe Commands
     */

    public function describe($des)
    {
        self::$description[self::$customCmd] = $des;
        return $this;
    }

    public function usage($des)
    {
        self::$usage[self::$customCmd] = $des;
        return $this;
    }

    public static function execute()
    {
        global $argc, $argv, $application_folder, $system_path, $config;

        /**
         * Predefined Command
         */
        AppCommand::execute();
    }


    /**
     * Output Functions
     */
    public static function comment($text)
    {
        echo self::$yellow . $text . "\n";
        echo self::$white; //white
    }

    public static function success($text)
    {
        echo self::$green . $text . "\n";
        echo self::$white; //white
    }

    public static function danger($text)
    {
        echo self::$red . $text . "\n";
        echo self::$white; //white
    }

    public static function line($text)
    {
        echo self::$white . $text . "\n";
        echo self::$white; //white
    }

    public static function info($text)
    {
        echo self::$blue . $text . "\n";
        echo self::$white; //white
    }
    /**
     * Get value from command prompt
     */
    public static function ask($text)
    {
        return readline($text);
    }
}
