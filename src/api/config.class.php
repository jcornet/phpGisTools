<?php
namespace phpGeoApi;
use phpGeoApi as PGA;

/**
*   This static class contains configuration (default values) for this API. All this static attributes are public so be carefull !
*/
class Config{
/**
*   Default date format
*/
    static public $DATE_FORMAT = "d/m/Y";
/**
*   Default timestamp format
*/
    static public $TIMESTAMP_FORMAT = "d/m/Y H:i:s";

/**
*   Default hour format
*/
    static public $HOUR_FORMAT = "H:i:s"; 
/**
*   Default out encoding
*/
    static public $ENCODING = "UTF-8";
    
    
/**
*   JSON variables (for json from datasource)
*/
    static public $JSON_DATA_KEY = "data";
    static public $JSON_COUNT_KEY = "count";
    static public $JSON_SUCCESS_KEY = "success";
    static public $JSON_MESSAGE_KEY = "msg";

/**----------------@TODO LATER (OR NEVER !) ----------------------------------------------------------------------------------------------*/
    // static public $OPENLAYERS_JS_PATH = "http://dev.openlayers.org/releases/OpenLayers-2.13.1/lib/OpenLayers.js";
    // static public $OPENLAYERS_CSS_PATH = "http://dev.openlayers.org/releases/OpenLayers-2.13.1/theme/default/style.css";
    
    static public $CACHE_ENABLED = false;
    static public $CACHE_PATH = false;
    static public $TMP_PATH = \PHPGEOAPI_FOLDER."tmp";
    static public $CONF_PATH = false;
    
}
