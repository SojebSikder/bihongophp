<?php
/**
 * Seed Class
 */
abstract class Seeder
{
    public function call($classes)
    {
        global $config;

        if(is_array($classes))
        {
            foreach ($classes as $class) 
            {
                if(! file_exists($config['seed_path']."$class.php"))
                {
                    echo "Class not found in this url: ".$config['seed_path']."$class.php";
                }else{
                    require $config['seed_path']."$class.php";
                }
    
                $classObj = new $class();
                if(! method_exists($classObj, 'run')){
                    echo "run() method not found";
                }else{
                    $classObj->run();
                }
            }
        }else{

            if(!file_exists($config['seed_path']."$classes.php"))
            {
                echo "Class not found in this url: ".$config['seed_path']."$classes.php";
            }else{
                require $config['seed_path']."$classes.php";
            }

            $class = new $classes();
            if(! method_exists($class, 'run'))
            {
                echo "run() method not found";
            }else{
                $class->run();
            }
        }
        
    }


}
