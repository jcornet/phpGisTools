<?php
namespace phpGeoApi\field\type;
use phpGeoApi AS PGA;
	
class String{
		
	public function minOK($field, $value){
		if($field->min !== false)
			return (strlen($value) >= $field->min);
                else return true;
	}
	
	public function maxOK($field, $value){
		if($field->max !==false)
			return (strlen($value) <= $field->max);
                else return true;
	}
	
	public function isValid($value){
		return is_int($value);
	}	
}