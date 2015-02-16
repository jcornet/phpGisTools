<?php
namespace phpGeoApi\utils;
use phpGeoApi as PGA;

/**
*   Static class with static methods for xml manipulation
*   @package phpGeoApi
*   @subpackage utils
*/
class Xml{
/**
*   Prepare string for inclusion in xml document
*   @param string $txt Text to prepare
*   @param boolean $cdata Prepare with CDATA method or reserved characters replacement. Default false.
*   @return string prepared text
*/    
    static public function prepareString(string $txt,boolean $cdata = false){
        if($cdata){
           return "<![CDATA[".$txt."]]>";
        }
        else {
            $in = array("&", "<", ">", "\"", "'");
            $out = array("&amp;", "&lt;", "&gt;", "&quot;", "&#39;");
            return str_replace($in, $out, $txt);
        }
    }
/**
*   Prepare attribute value for inclusion in xml document
*   @param string $txt Text to prepare
*   @return string prepared text
*/    
    static public function prepareAttribute(string $value){
        $in = array("&", "<", ">", "\"", "'","\r", "\n");
        $out = array("&amp;", "&lt;", "&gt;", "&quot;", "&#39;", "&#13;", "&#10;");
        //replace xml special charcaters
        return str_replace($in, $out, $value);
    }

/**
 * Transforms the contents of a DOMNode to an associative array
 * @param DOMNode $node DOMDocument node
 * @return string|array Associative array or string with node content
 */
    static public function domNodeToArray($node){
        $result = '';

        if ($node->hasChildNodes()) {
            if ($node->firstChild === $node->lastChild
                && $node->firstChild->nodeType === \XML_TEXT_NODE
            ) {
                // Node contains nothing but a text node, return its value
                $result = trim($node->nodeValue);
            } else {
                // Otherwise, do recursion
                $result = array();
                foreach ($node->childNodes as $child) {
                    if ($child->nodeType !== \XML_TEXT_NODE) {
                        // If there's more than one node with this node name on the
                        // current level, create an array
                        if (isset($result[$child->nodeName])) {
                            if (!is_array($result[$child->nodeName])
                                || !isset($result[$child->nodeName][0])
                            ) {
                                $tmp = $result[$child->nodeName];
                                $result[$child->nodeName] = array();
                                $result[$child->nodeName][] = $tmp;
                            }
                            
                            $result[$child->nodeName][] = static::domNodeToArray($child);
                        } else {
                            $result[$child->nodeName] = static::domNodeToArray($child);
                        }
                    }
                }
            }
        }

        return $result;
    }

/**
 * Transforms the contents of an associative array to an xml string
 * @param Array $array The array to parse
 * @return string Xml string
 */
    static public function arrayToXmlString(Array $array){
        $result = "";
        foreach($array AS $id => $value){
            if(is_array($value))
                $result .= (!is_numeric($id)) 
                    ? "<".static::prepareAttribute($id).">".static::arrayToXmlString($value)."</".static::prepareAttribute($id).">"
                    : static::arrayToXmlString($value);
            else
               $result .= (!is_numeric($id)) 
                    ? "<".static::prepareAttribute($id).">".static::prepareString($value)."</".static::prepareAttribute($id).">"
                    : static::prepareString($value); 
        }
        return $result;
    }

}
