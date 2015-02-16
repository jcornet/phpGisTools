<?php

const PHPGEOAPI_CORE_FOLDER = __DIR__.DIRECTORY_SEPARATOR;
const PHPGEOAPI_VERSION = "0.1";

//function for geoPHP load
function geoPHPLoader($classname){
	$geoPHP_classes = array(
		"geoPHP" => 1,
		"Collection" => 2, //2 pour dossier Geometry
		"Geometry" => 2,
		"GeometryCollection" => 2,
		"LineString" => 2,
		"MultiLineString" => 2,
		"MultiPoint" => 2,
		"MultiPolygon" => 2,
		"Point" => 2,
		"Polygon" => 2,
		"EWKB" => 3, //3 pour dossier Adapters
		"EWKT" => 3,
		"GeoAdapter" => 3,
		"GeoHash" => 3,
		"GeoJSON" => 3,
		"GeoRSS" => 3,
		"GoogleGeocode" => 3,
		"GPX" => 3,
		"KML" => 3,
		"WKB" => 3,
		"WKT" => 3,
	);
	if(isset($geoPHP_classes[$classname])){
		//Construction du chemin
		$file = PHPGEOAPI_CORE_FOLDER."external_libs".DIRECTORY_SEPARATOR."geoPHP".DIRECTORY_SEPARATOR; //Base
		$type = $geoPHP_classes[$classname];
		if($type==2)
			$file .= "lib".DIRECTORY_SEPARATOR."geometry".DIRECTORY_SEPARATOR;
		else if($type==3)
			$file .= "lib".DIRECTORY_SEPARATOR."adapters".DIRECTORY_SEPARATOR;
		$file .= $classname;
		if($type==1)
			$file .= ".inc";
		else $file .= ".class.php";
		return (file_exists($file) && require($file));
	}	
}

//function for phpGeoApi load
function phpGeoApiLoader($classname){
    $file = false;
	
    if(substr($classname, 0, 1)=="\\") 
            $classname = substr($classname, 1); //If class name begins with \, remove it

    $tree = explode("\\", strtolower($classname));

    if($tree[0]=="phpGeoApi")
        $file = strtolower(str_replace("\\", DIRECTORY_SEPARATOR, $classname).".class.php");
    else if($tree[0]=="PGA"){
        $classname = str_replace("PGA", "phpGeoApi",$classname);
        $file = strtolower(str_replace("\\", DIRECTORY_SEPARATOR, $classname).".class.php");
    }
    else {
        return false;
    }
    //load File (with require)
    return ($file && file_exists($file) && require($file));
}

//Load this autoload functions in autoload stack
spl_autoload_register("geoPHPLoader");
spl_autoload_register("phpGeoApiLoader");
