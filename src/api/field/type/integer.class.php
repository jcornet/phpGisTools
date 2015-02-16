<?php
namespace phpGeoApi\field\type;
use phpGeoApi AS PGA;
	
class Integer{
	
	public function minOK($field, $value){
		if($field->min !== false)
			return ($field->min <= $value);
                else return true;
	}
	
	public function maxOK($field, $value){
		if($field->max !==false)
			return ($field->max >= $value);
                else return true;
	}
	
	public function isValid($value){
		return is_int($value);
	}	
}