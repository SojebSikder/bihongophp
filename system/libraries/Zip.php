<?php
/**
 * Zip Library
 */
class Zip
{
    private $zip;

    public function __construct(){
        $this->zip = new ZipArchive;
    }

    /**
     * Zip
     */
    public function zip($url, $rootPath){
        $res = $zip->open($url, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath));

        foreach($files as $name => $file){
            if(!$file->isDir()){
              $filePath = $file;//->getRealPath();
              $relativePath = substr($filePath, strlen($rootPath) + 1);
        
              $zip->addFile($filePath, $relativePath);
        
              return true;
              
            }else{
              return false;
            }
          }
          $zip->close();
    }

    /**
     * Unzip
     */
    public function unzip($url, $distination){
        $res = $zip->open($url);
        if ($res === TRUE) {
            $zip->extractTo($distination);
            $zip->close();
            
            return true;
        }else{
            return false;
        }
    }
    
}



?>