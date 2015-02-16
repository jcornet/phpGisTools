<?php
namespace phpGeoApi;
use phpGeoApi as PGA;

class Field {
	protected $form_type = 'text';
	
	static protected $types_allowed = array(
		"int",
		"float",
		"string",
		"text",
		"boolean",
		"datetime",
		"date",
		"time",
		"year"
	);
	
//    protected $core_options = array();
    protected $additionnal_options = array();
        
        
	static protected $options_boolean = array();
	
	static protected $options_integer = array();
	
	static protected $options_float = array();
	
	static protected $options_array = array();
	
	static protected $options_string = array(
		"css_class",
		"style"
	);
	
	
	protected $id = false;
	protected $name = false;
	protected $label = false;
	protected $type = false;
	protected $src_type = false;
	protected $allow_html = false;
    protected $regexp_correct = false;
    protected $regexp_wrong = false;
	
	
	protected $max = false;
	protected $min = false;
	protected $default_value = false;
	protected $value = false;
	
	
	public function __construct($name, $options = false){
		$this->setName($name);
		if(is_string($options))
			$options = json_decode($options);
		if(is_array($options)){
			foreach($options AS $opt_name => $opt_value){
                if(isset($this->$opt_name))
				    $this->$opt_name = $opt_value;
                else
                    $this->additionnal_options[$opt_name] = $opt_value;
            }
		}
		return true;
	}	
	
	abstract public function correctValue($value);
	abstract public function prepareValue($value);

    public function setSrcType($value){
		$this->src_type = $value;
		return true;
	}
	
	public function setId($value){
		$this->id = $value;
	}
	
	public function setDefaultValue($value){
		if(!$this->correctValue($value))
			return false;
		
		return($this->default_value = $value);
	}
	
	public function setValue($value){
		if(!$this->correctValue($value))
			return false;
		
		return($this->value = $value);
	}
	
	public function setMin($value){
		
	}
	public function setMax($value){
		
	}
	
	public function setName($value){
		return($this->name = $value);
	}
	
	public function setLabel($value){
		return($this->label = $value);
	}
	
		
	public function __get($name){
		return (isset($this->$name)) ? $this->$name : null;
	}
	
	
	public function __set($name, $value){
		
		$method_name = "set".ucfirst(strtolower($name));
		if(method_exists($this, $method_name))
			return $this->$method_name($value);
		
		if(is_array($value)){
			if(in_array($name, static::$options_array)){
				$this->$name = $value;
				return true;
			}
		}
		
		if(is_bool($value)){
			if(in_array($name, static::$options_boolean)){
				$this->$name = $value;
				return true;
			}
		}
		
		if(is_int($value)){
			if(in_array($name, static::$options_integer)){
				$this->$name = $value;
				return true;
			}
		}
		
		if(is_float($value)){
			if(in_array($name, static::$options_float)){
				$this->$name = $value;
				return true;
			}
		}
		
		if(is_string($value)){
			if(in_array($name, static::$options_string)){
				$this->$name = $value;
				return true;
			}
		}
		
		return false;
	}
}
