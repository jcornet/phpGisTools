<?php
namespace phpGeoApi;
use phpGeoApi as PGA;
class Output {
    protected $renderer = false;
    
    public function __construct($renderer){
        if(!$renderer = static::getRenderer($renderer))
                return false;
        
    }
    
    static public function getRenderer($renderer){
        if(is_object($renderer) && is_subclass_of($renderer, "phpGeoApi\\output\\Renderer", false))
                return $renderer;
        else{
            $class_name = "\\phpGeoApi\\output\\".ucfirst(strtolower($renderer));
            return new $class_name($this);
        }
    }
    
    public function out(){
        $this->renderer->out();
    }
    
    public function show(){
        $this->renderer->show();
    }
    
    public function renderer(){
        return $this->renderer;   
    }
}
