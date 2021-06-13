<?php

namespace System\Core;

/**
 * Loader Class
 */
class Load
{
    /**
     * Load View
     */
    public function view($filename, $data = false)
    {
        global $view_folder_path, $application_folder, $system_path, $config;

        if ($data == true) {
            extract($data);
        }

        $file = explode(".", $filename);

        /**
         * For using Template Engine
         */
        if (isset($file[1])) {
            if ($file[1] == "te") {
                if (isset($file[2])) {
                    //include $application_folder."/"."views/".$filename;
                    include $view_folder_path . "/" . $filename;
                } else {
                    require_once "Perser2.php";
                    // Initialize object
                    //Perser2::view($application_folder."/"."views/".$filename.".php", $data);
                    Perser2::view($view_folder_path . "/" . $filename . ".php", $data);
                }
            }
            //End Template Engine


            else if ($file[1] == "php") {
                if (!file_exists($view_folder_path . "/" . $filename)) {
                    echo "View File not found: " . $application_folder . "/" . "views/" . $filename;
                } else {
                    //include $application_folder."/"."views/".$filename;
                    include $view_folder_path . "/" . $filename;
                }
            } else if ($file[1] != "php") {
                if (!file_exists($view_folder_path . "/" . $filename)) {
                    echo "View File not found: " . $view_folder_path . "/" . $filename;
                } else {
                    //include $application_folder."/"."views/".$filename;
                    include $view_folder_path . "/" . $filename;
                }
            } else {
                if (!file_exists($view_folder_path . "/" . $filename . ".php")) {
                    echo "View File not found: " . $view_folder_path . "/" . $filename . ".php";
                } else {
                    include $view_folder_path . "/" . $filename . ".php";
                }
            }
        } else {
            if (!file_exists($view_folder_path . "/" . $filename . ".php")) {
                echo "View File not found: " . $view_folder_path . "/" . $filename . ".php";
            } else {
                include $view_folder_path . "/" . $filename . ".php";
            }
        }
    }

    /**
     * Load Model
     */
    public function model($modelname)
    {
        global $application_folder, $system_path;

        if (!file_exists($application_folder . "/" . "models/" . $modelname . ".php")) {
            echo "Model not found: " . $application_folder . "/" . "models/" . $modelname . ".php";
        } else {
            include $application_folder . "/" . "models/" . $modelname . ".php";
        }
        return new $modelname();
    }

    /**
     * Load Helper
     */
    public function helper($helpername)
    {
        global $application_folder, $system_path;

        if (is_array($helpername)) {
            foreach ($helpername as $name) {
                if (file_exists($application_folder . "/" . "helpers/" . $name . ".php")) {
                    include $application_folder . "/" . "helpers/" . $helpername . ".php";
                } elseif (!file_exists($application_folder . "/" . "helpers/" . $name . ".php")) {
                    if (file_exists($system_path . "/" . "helpers/" . $name . ".php")) {
                        include $system_path . "/" . "helpers/" . $name . ".php";
                    } elseif (!file_exists($system_path . "/" . "helpers/" . $name . ".php")) {
                        echo "Helper File not found: " . $system_path . "/" . "helpers/" . $name . ".php";
                    }
                }
            }
        } else {
            if (file_exists($application_folder . "/" . "helpers/" . $helpername . ".php")) {
                include $application_folder . "/" . "helpers/" . $helpername . ".php";
            } elseif (!file_exists($application_folder . "/" . "helpers/" . $helpername . ".php")) {
                //echo "Helper File no found: ".$application_folder."/"."helpers/".$helpername.".php";
                if (file_exists($system_path . "/" . "helpers/" . $helpername . ".php")) {
                    include $system_path . "/" . "helpers/" . $helpername . ".php";
                } elseif (!file_exists($system_path . "/" . "helpers/" . $helpername . ".php")) {
                    echo "Helper File not found: " . $system_path . "/" . "helpers/" . $helpername . ".php";
                }
            }

            //return new $helpername();
        }
    }

    /**
     * Load Library
     */
    public function library($libraryname)
    {
        global $application_folder, $system_path;

        if (is_array($libraryname)) {
            foreach ($libraryname as $name) {
                if (file_exists($application_folder . "/" . "libraries/" . $name . ".php")) {
                    include $application_folder . "/" . "libraries/" . $name . ".php";
                } elseif (!file_exists($application_folder . "/" . "libraries/" . $name . ".php")) {

                    if (!file_exists($system_path . "/" . "libraries/" . $name . ".php")) {
                        echo "Library File not found: " . $system_path . "/" . "libraries/" . $name . ".php";
                    } else {
                        include $system_path . "/" . "libraries/" . $name . ".php";
                    }
                }
            }
        } else {

            if (file_exists($application_folder . "/" . "libraries/" . $libraryname . ".php")) {
                include $application_folder . "/" . "libraries/" . $libraryname . ".php";
            } elseif (!file_exists($application_folder . "/" . "libraries/" . $libraryname . ".php")) {
                if (file_exists($system_path . "/" . "libraries/" . $libraryname . ".php")) {
                    include $system_path . "/" . "libraries/" . $libraryname . ".php";
                } elseif (!file_exists($system_path . "/" . "libraries/" . $libraryname . ".php")) {
                    echo "Library File not found: " . $system_path . "/" . "libraries/" . $libraryname . ".php";
                }
            }
        }
    }
}
