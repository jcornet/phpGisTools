<?php
namespace phpGeoApi\adapter;
use phpGeoApi as PGA;

abstract class Adapter{
    protected $tmp_folder = false;
    protected $filenames = array();
    protected $files = array();
    protected $domDocument = false;
    protected $tags1 = false;
    protected $tags2 = false;
    
    protected $extension = false;
    protected $type_mime = 'text/plain';
    
    protected $in_encoding = 'auto';
    protected $out_encoding = 'UTF-8';
    
    protected $mode_read = false;
    protected $mode_write = false;

    protected $destroy_files_on_close = false;
    
    public function __construct($options){

    }
    
    
    abstract public function openFile($filepath);
    abstract public function createFile($filepath);

    public function openFromURI($URI){
		$this->destroy_files_on_close = true;
		$filepath = \PGA\Config::$TMP_PATH.\DIRECTORY_SEPARATOR.\PGA\utils\String::random(35);
		copy($URI, $filepath);

		return (file_exists($filepath))
			? $this->openFile($filepath)
			: false;
    }
    abstract public function close();
    abstract public function rewind();
    
    
    abstract public function varToRow();
    abstract public function rowToVar();
    abstract public function rowSeparator();
    abstract public function formatHeader();
    abstract public function formatFooter();

    abstract public function nextRow();
    abstract public function insertRow();

    public function sendHeaders($forceDownload=true){

    }
    
    public function setFields($fieldsCollection){

    }


    public function setInEncoding(string $encoding, $controlIfExists = false){
        if($encoding!="auto" && $controlIfExists && !  \PGA\utils\Encoding::isSupported($encoding))
            return false;
        $this->in_encoding=$encoding;
    }
    
    public function setOutEncoding(string $encoding, $controlIfExists = false){
        if($encoding=="auto" || ( $controlIfExists && !  \PGA\utils\Encoding::isSupported($encoding)) )
            return false;
        $this->out_encoding=$encoding;
    }

    public function inEncoding(){
        return $this->in_encoding;
    }

    public function outEncoding(){
        return $this->out_encoding;
    }

    public function __destruct(){
        if($this->destroy_files_on_close && count($this->files)>0){
            foreach($this->files AS $idx => $file){
                fclose($file);
                unset($this->files[$idx]);
            }
        }
        if($this->domDocument){
            unset($this->domDocument);
        }
        if($this->tmp_folder){
            \PGA\utils\Folder::rm(true, false);
        }  
    }    
}
