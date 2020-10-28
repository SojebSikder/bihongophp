<?php
/**
 * Show error
 * @param string $text error description
 * @return void
 */
function show_error($text){
    global $config;
    
    if($config['mode'] == "production"){
        return false;
    }else{    
        echo "<strong>Error:</strong> $text";
    }
}

function show_404(){
    echo "404 not found";
}