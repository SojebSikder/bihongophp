<?php
/**
 * Image Library
 */
class ImageLib
{

    public static function compressImage($source_url, $destination_url, $quality){
        $info = getimagesize($source_url);
        if($info['mime'] == 'image/jpg'){
            $image = imagecreatefromjpeg($source_url);
        }elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefrompgif($source_url);
        }
        elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source_url);
        }

        imagejpeg($image, $destination_url, $quality);
        return true;
    }
}

?>