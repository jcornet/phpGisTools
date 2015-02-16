<?php
namespace phpGeoApi\field\type;
use phpGeoApi AS PGA;
	
class Float extends Integer{	
	public function isValid($value){
		return is_numeric($value);
	}	
}