<?php
 
namespace Utils\ImageLibrary;

use Intervention\Image\ImageManagerStatic as Image;


class ImageLibrary {

    public static $size = [
        "s" => [ 105, 148],
        "m" => [ 210, 297],
        "l" => [ 594, 841],
        "xl" => [ 1188, 1682]
    ];

    public static $uploadDir = "upload/";

    public static function displayName(){
        return "Laravel Framework";
    }

    public static function writeFile($uploadedFile, $name, $extension){
        foreach ( ImageLibrary::$size as $size => $values) {
            $img = Image::make($uploadedFile);
            if ($img->width() > $values[0] || $img->height() > $values[1]) {
                $img->resize($values[0], $values[1]);
                $img->save(ImageLibrary::$uploadDir.$name."-".$values[0]."x".$values[1].".".$extension, 80);
            }
        }
        $img = Image::make($uploadedFile);
        $img->save(ImageLibrary::$uploadDir.$name."-ori.".$extension, 80);
    }

    public static function sizeToString($size){
        if(array_key_exists($size, self::$size)){
            return ImageLibrary::$size[$size][0]."x".ImageLibrary::$size[$size][1];
        } else { return "";}
    }

    public static function getFile($filename, $size = "ori"){
        $filePath = ImageLibrary::$uploadDir.$filename;
        $dir =  pathinfo($filePath, PATHINFO_DIRNAME  ); 
        $name = pathinfo($filePath, PATHINFO_FILENAME ); 
        $ext =  pathinfo($filePath, PATHINFO_EXTENSION);
        if (array_key_exists($size, self::$size) && file_exists($dir."/".$name."-".self::sizeToString($size).".".$ext))
            return $dir."/".$name."-".self::sizeToString($size).".".$ext;
        else if (file_exists($dir."/".$name."-ori.".$ext))
            return $dir."/".$name."-ori.".$ext;
        else
            return "img/default_avatar.png";
    }



}