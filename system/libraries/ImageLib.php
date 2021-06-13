<?php
namespace System\Libraries;
/**
 * Image Library
 */
class ImageLib
{
    public static $avaterPath;
    public static $fontPath;

    /**
     * Set output folder path
     */
    public static function setAvaterPath($avaterPath){
        self::$avaterPath = $avaterPath;
    }
    /**
     * Set font path
     */
    public static function setFontPath($fontPath){
        self::$fontPath = $fontPath;
    }

    /**
     * Make avater from character
     */
    public static function makeAvater($character)
    {
        $path = self::$avaterPath.'.png';
        $font = realpath(self::$fontPath);

		$image = imagecreate(200, 200);
		$red = rand(0, 255);
		$green = rand(0, 255);
		$blue = rand(0, 255);
	    imagecolorallocate($image, $red, $green, $blue);  
	    $textcolor = imagecolorallocate($image, 255,255,255);

        
        imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);
	    imagepng($image, $path);
        imagedestroy($image);

	    return $path;
    }


    /**
     * Compress Image little bit
     */
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
