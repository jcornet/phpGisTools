<?php
namespace phpGeoApi;
use phpGeoApi as PGA;

/**
*   Form generation
*   @description Class to generate form, validate form, get (cleaned) form data...
*/
class Form {

    protected $fields = array();
    protected $id = false;
    protected $title = false;
    protected $target = false;
    protected $method = "POST";
    protected $action = "?";
    protected $html_style = false;
    protected $html_class = false;
    protected $protect_for_resubmit = false;
    protected $values = array();

    /**
     * 	State of this form
     * 	1 : created
     * 	2 : rendered
     * 	3 : submit succesfully
     * 	-3 : submit but with errors
     */
    protected $state = 0;

    public function __construct($config) {
        if (is_string($config))
            $config = json_decode($config);
    }

    public function state() {
        return $this->state;
    }

    protected function setState(integer $state) {
        if (is_integer($state) && $state > -3 && $state < 3) {
            $this->state = $state;
            return true;
        }
        return false;
    }

    public function setTarget($target = false) {
        if (!$target) {
            $this->target = false;
            return true;
        }
        $ok_targets = array('_blank', '_self');
        if (in_array($target, $ok_targets)) {
            $this->target = $target;
            return true;
        }
        else
            return false;
    }

    public function target() {
        return $this->target;
    }

    public function setAction($action = "?") {
        $this->action = $action;
    }

    public function action() {
        return $this->action;
    }

    public function authorizeMultipleSubmit(boolean $bool) {
        $this->protect_for_resubmit = $bool;
    }

    public function multipleSubmitAllowed() {
        return $this->protect_for_resubmit;
    }

    public function setId(string $id) {
        $this->id = $id;
    }

    public function id() {
        return $this->id();
    }

    public function setHtmlClass(string $className) {
        $this->html_class = $className;
    }

    public function htmlClass() {
        return $this->html_class;
    }

    public function setStyle(string $style) {
        $this->html_style = $style;
    }

    public function style() {
        return $this->html_style;
    }

    public function setTitle(string $title) {
        $this->title = $title;
    }

    /**
     *  @brief Add a field
     *  
     *  @param [in] $field Must be a field object or a json field description (as string)
     *  @return boolean Ok ?
     *  
     *  @details Details
     */
    public function addField($field) {
        if (is_string($field))
            $field = \PGA\Field::get($field);
        if ($field && is_object($field) && $field->name) {
            $this->fields[$field->name] = $field;
            return true;
        }
        else
            return false;
    }

    /**
     *  @brief Add fields
     *  
     *  @param [in] $fields Must be an array of field objects or a json fields description (as string)
     *  @return boolean Ok ?
     *  
     *  @details Details
     */
    public function addFields($fields) {
        if (is_string($fields)) {
            $fields = json_decode($fields);
            if (!is_array($fields))
                return false;
            foreach ($fields AS $field) {
                $field = \PGA\Field::get($field);
                if (!$field)
                    return false;
                $this->fields[$field->name] = $field;
            }
        }
        else if (is_array($fields)) {
            foreach ($fields AS $field) {
                if ($field && is_object($field) && $field->name) {
                    $this->fields[$field->name] = $field;
                }
                else
                    return false;
            }
            return true;
        }
        return false;
    }

    public function setFields($fields) {
        $this->fields = array();
        return $this->addFields($fields);
    }
    public function fields(){
        return $this->fields;
    }

    public function setValue(string $name, $value) {
        if (!array_key_exists($name, $this->fields))
            return false;
        if ($this->fields[$name]->correctValue($value)) {
            $this->values[$name] = $value;
            return true;
        }
        return false;
    }

    public function setValues(array $values, boolean $all_corrects = false) {
        if ($all_corrects) {
            foreach ($values AS $name => $value)
                if (!array_key_exists($name, $this->fields) || !$this->fields[$name]->correctValue($value))
                    return false;
        }

        foreach ($values AS $name => $value)
            $this->setValue($name, $value);
        return true;
    }

    public function out($renderer = 'html5') {
        if (!$renderer = static::getRenderer($renderer))
            return false;
        return $renderer->out();
    }

    public function show($renderer = 'html5') {
        if (!$renderer = static::getRenderer($renderer))
            return false;
        $renderer->show();
        return true;
    }

    static protected function getRenderer($renderer) {
        if(is_object($renderer) && is_subclass_of($renderer, "phpGeoApi\\form\\Renderer", false))
            return $renderer;
        else{
            $class_name = "\\phpGeoApi\\form\\".$renderer;
            return new $class_name($this);
        }
    }

}
