<?php

/**
 * Router Class
 */
class Router
{
    public static function init()
    {
        global $config, $route, $email, $application_folder, $system;

        //Core
        $url = isset($_GET['url']) ? $_GET['url'] : NULL;
        if ($url != NULL) {
            $url = rtrim($url, '/');
            $url = explode("/", filter_var($url, FILTER_SANITIZE_URL));
        } else {
            unset($url);
        }



        $isError = false;
        /**
         * Custom Model View Controller
         */
        if (isset($url[0])) {

            if (file_exists("app/controllers/" . $url[0] . ".php")) {
                require "app/controllers/" . $url[0] . ".php";
                $class = new $url[0]();
                if (isset($url[1])) {
                    $method = $url[1];
                    //$class->$method();
                    /**
                     * New addition for peramiter
                     */
                    if ((isset($url[2])) && (!isset($url[3]))) {
                        $class->$method($url[2]);
                    } else if (isset($url[3]) && (!isset($url[4]))) {
                        $class->$method($url[2], $url[3]);
                    } else if (isset($url[4]) && (!isset($url[5]))) {
                        $class->$method($url[2], $url[2], $url[4]);
                    } else if (isset($url[4]) && (!isset($url[5]))) {
                        $class->$method($url[2], $url[3], $url[4], $url[5]);
                    } else {
                        $class->$method();
                        $isError = false;
                    }
                    //end that  
                } else {
                    $class->home();
                    $isError = false;
                }
            } else {
                //echo "Not";
                $isError = true;
            }
        }
        // End that
        foreach ($route as $key => $value) {
            $breakKey = explode("/", filter_var($key, FILTER_SANITIZE_URL));
            $break = explode("/", filter_var($value, FILTER_SANITIZE_URL));
            /**
             * Default Route
             */
            if (!isset($url[0])) {
                if ($route['default_controller'] != null) {
                    /**
                     * Call function from routes
                     */
                    if (is_callable($route['default_controller'])) {
                        $controller = new Controller();
                        try {
                            $route['default_controller']($controller);
                        } catch (\Throwable $th) {
                            throw $th;
                        }
                        break;
                    }
                    /**
                     * If not callable then continue
                     */
                    else {
                        require $application_folder . "\/controllers/" . $break[0] . ".php"; //Controller
                        $class = ucfirst($break[0]); //Controller
                        $ur = new $class();
                        if (isset($break[1])) {
                            $method = $break[1];
                        } else {
                            $method = "home";
                        }
                        $ur->$method();
                        break;
                    }
                }
            } else
                //if($url[0] == $key)
                if (filter_var($_GET['url'], FILTER_SANITIZE_URL) != null) {
                    $count = count($breakKey);
                    //echo $count." ";
                    $fullurl = '';
                    for ($i = 0; $i < $count; $i++) {
                        if (isset($url[$i])) {
                            $fullurl .= $url[$i] . "/";
                        }
                    }
                    $fullurl = rtrim($fullurl, '/' . PHP_EOL);
                }
        }


        if (isset($fullurl)) {
            /**
             * Continue if route key exist
             */
            if (array_key_exists($fullurl, $route)) {
                /**
                 * Call function from routes
                 */
                if (is_callable($route[$fullurl])) {
                    $controller = new Controller();

                    try {
                        $route[$fullurl]($controller);
                    } catch (\Throwable $th) {
                        throw $th;
                    }
                }
                /**
                 * If it's not callback then continue
                 */
                else {
                    $break = explode("/", $route[$fullurl]);
                    /**
                     * Form Routes File
                     */
                    //$class = $break[0];
                    //$method = $break[1];
                    //$perameter = $break[2];

                    /**
                     * $url[0] = controller
                     * $url[1] = method
                     * $url[2] = perameter
                     */
                    if (isset($break[0])) {
                        if (file_exists($application_folder . "/" . "controllers/" . $break[0] . ".php")) {
                            $s = ucfirst($break[0]); //Controller
                            if (!class_exists($s)) {
                                require $application_folder . "/" . "controllers/" . $break[0] . ".php"; //Controller

                                if (!class_exists($s)) {
                                    show_error("Class not exist: <strong>" . $s . "</strong>");
                                    //break;
                                } else {
                                    $ur = new $s();
                                }
                            }
                        } else {
                            show_error("Controller not exist: <strong>" . $break[0] . "</strong>");
                        }

                        if (isset($break[2])) {
                            $method = $break[1];
                            $ur->$method($break[2]);
                        } else {
                            if (isset($break[1])) {
                                $method = $break[1];

                                if (!method_exists($ur, $method)) {
                                    show_error("Method not exist: <strong>" . $method . "</strong>");
                                }
                                /**
                                 * New addition for peramiter
                                 */
                                if ((isset($url[$count])) && (!isset($url[$count + 1]))) {
                                    $ur->$method($url[$count]);
                                } else if (isset($url[$count + 1]) && (!isset($url[$count + 2]))) {
                                    $ur->$method($url[$count], $url[$count + 1]);
                                } else if (isset($url[$count + 2]) && (!isset($url[$count + 3]))) {
                                    $ur->$method($url[$count], $url[$count + 1], $url[$count + 2]);
                                } else if (isset($url[$count + 3]) && (!isset($url[$count + 4]))) {
                                    $ur->$method($url[$count], $url[$count + 1], $url[$count + 2], $url[$count + 3]);
                                } else {
                                    $ur->$method();
                                }
                                //end that  
                            } else {
                                $ur->home();
                            }
                        }
                    } else {
                        require $application_folder . "\/controllers/" . $break[0] . ".php"; //Controller
                        $class = ucfirst($break[0]); //Controller
                        $ur = new $class();
                        if (isset($break[1])) {
                            $method = $break[1];
                        } else {
                            $method = "home";
                        }
                        $ur->$method();
                    }
                    //end core

                }
            } else {
                if ($isError == true) {
                    show_404();
                }
            }
        }
    }
}
