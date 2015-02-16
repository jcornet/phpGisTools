<?php
namespace phpGeoApi\utils;
use phpGeoApi as PGA;

/**
*   Static class with folder methods
*   @package phpGeoApi
*   @subpackage utils
*/
class Folder{

	static public function rm(string $folder_path){
		return static::_remove($folder_path, false, false);
	}

	static public function rmContent(string $folder_path){
		return static::_remove($folder_path, true, false);
	}

	static public function rmFiles(string $folder_path, $destroy_files_pattern=false, $ignore_files_patterns = false){
		if(!$ignore_files_names && !$ignore_files_patterns)
			return static::_remove($folder_path, true, true);

		if($destroy_files_pattern && $ignore_files_patterns)
			return false;

		if($destroy_files_pattern && !is_array($destroy_files_pattern))
			return false;

		if($ignore_files_patterns && !is_array($ignore_files_patterns))
			return false;



	}


	static protected function _remove(string $folder_path, $let_this_empty_folder = false, $let_subFolders = false){

	}


	static public function zip(string $folder_path, string $zip_path){

	}
}
