<?php
namespace App\Core;

class Config {

    public static function file($file){
        if(!is_file($file)){
            return false;
        }
        return include $file;
    }


    public static function env($envFile){
        $envVars = file($envFile);
        
        foreach($envVars as $envVar){
            putenv(trim($envVar));
        }
    }

    public static function dir($dir){
        if(!is_dir($dir)){
            return false;
        }
        $conf = [];
        $files = scandir($dir);
        foreach($files as $file){
            if($file === '.' || $file === '..') continue;
            $nameFile = pathinfo($file,PATHINFO_FILENAME);
            $conf[$nameFile] = include $dir.'/'.$file;
        }
        return $conf;
    }
}