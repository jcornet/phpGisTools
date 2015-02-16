<?php
namespace phpGeoApi\utils;
use phpGeoApi as PGA;

/**
*   Static class with encoding static methods
*   @package phpGeoApi
*   @subpackage utils
*/
class Encoding{
    
    
    static public function convert($var, $from_encoding = 'auto', $to_encoding = false){
        if(!$to_encoding)
            $to_encoding = \PGA\Config::$ENCODING;
        if(is_array($var))
            return static::convertArray($var, $from_encoding, $to_encoding);
        else if(is_numeric($var))
            return $var;
        else if(is_string($var))
            return static::convertString($var, $from_encoding, $to_encoding);
        else
            return false;       
    }
    
    static public function convertString(string $string, $from_encoding = 'auto', $to_encoding = false){
        if(!$to_encoding)
            $to_encoding = \PGA\Config::$ENCODING;
        if($from_encoding==$to_encoding || mb_check_encoding($string, $to_encoding))
            return $string;        
        if($from_encoding=='auto'){
            $from_encoding = mb_detect_encoding($string);
            if(!$from_encoding)
                return false;
        }
        
        return mb_convert_encoding($string, $to_encoding, $from_encoding);        
    }
    
    static public function convertArray(array $array, $from_encoding = 'auto', $to_encoding = false){
        if(!$to_encoding)
            $to_encoding = \PGA\Config::$ENCODING;
        
        $result = array();
        foreach($array AS $id => $value){
            if(!is_numeric($id))
                $id = static::convertString($id, $from_encoding, $to_encoding);
            
            if(is_array($value)){
                $value = static::convertArray($value, $from_encoding, $to_encoding);
            }
            else
                $value =  static::convertString($value, $from_encoding, $to_encoding);
            
            if(!$value)
                    return false;
            else
                $result[$id] = $value;
        }
        return $result;
    }
    
    static protected $list_encodings = false;
    static public function listSupported(){
        if(!static::$list)
            static::$list = mb_list_encodings();
        
        return static::$list;
    }
    
    static public function isSupported(string $encoding){
        return in_array($encoding, static::listSupported());
    }
}