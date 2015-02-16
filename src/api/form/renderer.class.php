<?php
namespace phpGeoApi\form;
use phpGeoApi as PGA;

/**
 * Description of renderer
 *
 * @author biotope
 */
abstract class Renderer {
    protected $form = false;
    protected $css_paths = array();
    protected $js_paths = array();
    
    public function __construct($form){
        $this->form = $form;
    }
    
    abstract public function out();
    abstract public function show();
    
    public function getCssPaths(){
        return $this->css_paths;
    }
    public function getJsPaths(){
        return $this->css_paths;
    }
    
    protected function includeExtJs(){
        
    }
    protected function includeOpenLayers(){
        
    }
    protected function includeGeoExt(){
        
    }
}
