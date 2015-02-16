<?php
namespace phpGeoApi\field\type;
use phpGeoApi AS PGA;
	
abstract class Type{
	
	public function name(){
		$class = get_class($this);
		$class = explode("\\", $class);

        return $class[count($class)-1];
	}
        
    public function control($field, $value){
        return ($this->isValid($value)
            && $this->minOK($field, $value)
            && $this->maxOK($field, $value));
	}
	
	
	abstract public function minOK($field, $value, $min);
	abstract public function maxOK($field, $value, $max);
	
	abstract public function isValid($value);
}
