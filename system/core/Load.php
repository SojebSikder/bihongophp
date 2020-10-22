<?php 
/**
 * Loader Class
 */
class Load{
    /**
     * Load View
     */
    public function view($filename, $data = false)
    {
        global $application_folder, $system_path, $config;

        if($data == true){
            extract($data);
        }

        $file = explode(".", $filename);

        /**
         * For using Template Engine
         */
        if(isset($file[1])){
            if($file[1] == "te"){
                if(isset($file[2])){
                    include $application_folder."/"."views/".$filename;
                }else{
                    //require_once "Perser.php";

                    require_once "Perser2.php";

                    // Initialize object
                    //$tpl = new Perser($application_folder."/"."views/".$filename.".php");

                    $tpl2 = new Perser2($application_folder."/"."views/".$filename.".php");
                    Perser2::view($application_folder."/"."views/".$filename.".php", 
                    [
                        'ROOT' => ROOT,
                        'CHARSET' => CHARSET,
                        'ICON' => ICON,
                        'TITLE' => TITLE,
                        'SLOGAN' => SLOGAN,
                        'ASSET' => ASSET,
                        'B_VERSION' => B_VERSION,
                        'csrf_token_name' => $config['csrf_token_name'],
                        'bdata' => $data
                    ]
                    );

                    /**
                     * Predefined Value
                     */
                    /*
                    $tpl->set('ROOT', ROOT);
                    $tpl->set('CHARSET', CHARSET);
                    $tpl->set('ICON', ICON);
                    $tpl->set('TITLE', TITLE);
                    $tpl->set('SLOGAN', SLOGAN);
                    $tpl->set('ASSET', ASSET);
                    $tpl->set('B_VERSION', B_VERSION); 
                    $tpl->set('csrf_token_name', $config['csrf_token_name']);
                    */

                    /**
                     * Custom Value
                     */
                    /*if($data){
                        foreach ($data as $key => $value) {
                            $tpl->set($key, $value);
                        } 
                    }
                    $tpl->render(); */
                }
                
            }
            //End Template Engine


            else if($file[1] == "php"){
                if(!file_exists($application_folder."/"."views/".$filename)){
                    echo "View File not found: ".$application_folder."/"."views/".$filename;
                }else{
                    include $application_folder."/"."views/".$filename;
                }
                
            }else if($file[1] != "php"){
                if(!file_exists($application_folder."/"."views/".$filename)){
                    echo "View File not found: ".$application_folder."/"."views/".$filename;
                }else{
                    include $application_folder."/"."views/".$filename;
                }
                
            }
            else{
                if(!file_exists($application_folder."/"."views/".$filename.".php")){
                    echo "View File not found: ".$application_folder."/"."views/".$filename.".php";
                }else{
                    include $application_folder."/"."views/".$filename.".php";
                }
                
            }


        }else{
            if(!file_exists($application_folder."/"."views/".$filename.".php")){
                echo "View File not found: ".$application_folder."/"."views/".$filename.".php";
            }else{
                include $application_folder."/"."views/".$filename.".php";
            }
        }
        
    }

    /**
     * Load Model
     */
    public function model($modelname)
    {
        global $application_folder, $system_path;

        if(!file_exists($application_folder."/"."models/".$modelname.".php")){
            echo "Model not found: ".$application_folder."/"."models/".$modelname.".php";
        }else{
            include $application_folder."/"."models/".$modelname.".php";
        }
        return new $modelname();
    }

    /**
     * Load Helper
     */
    public function helper($helpername)
    {
        global $application_folder, $system_path;

        if(is_array($helpername))
        {
            foreach ($helpername as $name) 
            {
                if(file_exists($application_folder."/"."helpers/".$name.".php")){
                    include $application_folder."/"."helpers/".$helpername.".php";
                    
                }elseif(!file_exists($application_folder."/"."helpers/".$name.".php")){
                    if(file_exists($system_path."/"."helpers/".$name.".php")){
                        include $system_path."/"."helpers/".$name.".php";
                    }
                    elseif(!file_exists($system_path."/"."helpers/".$name.".php")){
                        echo "Helper File not found: ".$system_path."/"."helpers/".$name.".php";
                    }
                }
                
            }
        }else{
            if(file_exists($application_folder."/"."helpers/".$helpername.".php")){
                include $application_folder."/"."helpers/".$helpername.".php";
                
            }elseif(!file_exists($application_folder."/"."helpers/".$helpername.".php")){
                //echo "Helper File no found: ".$application_folder."/"."helpers/".$helpername.".php";
                if(file_exists($system_path."/"."helpers/".$helpername.".php")){
                    include $system_path."/"."helpers/".$helpername.".php";
                }
                elseif(!file_exists($system_path."/"."helpers/".$helpername.".php")){
                    echo "Helper File not found: ".$system_path."/"."helpers/".$helpername.".php";
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

        if(is_array($libraryname))
        {
            foreach ($libraryname as $name) 
            {
                if(file_exists($application_folder."/"."libraries/".$name.".php")){
                    include $application_folder."/"."libraries/".$name.".php";
                }elseif(!file_exists($application_folder."/"."libraries/".$name.".php")){

                    if(!file_exists($system_path."/"."libraries/".$name.".php")){
                        echo "Library File not found: ".$system_path."/"."libraries/".$name.".php";
                    }else{
                        include $system_path."/"."libraries/".$name.".php";
                    }
                }
                
                
            }
        }else{

            if(file_exists($application_folder."/"."libraries/".$libraryname.".php")){
                include $application_folder."/"."libraries/".$libraryname.".php";
                
            }elseif(!file_exists($application_folder."/"."libraries/".$libraryname.".php")){
                if(file_exists($system_path."/"."libraries/".$libraryname.".php")){
                    include $system_path."/"."libraries/".$libraryname.".php";
                }
                elseif(!file_exists($system_path."/"."libraries/".$libraryname.".php")){
                    echo "Library File not found: ".$system_path."/"."libraries/".$libraryname.".php";
                }
            }
            
        }
    }
}
?>