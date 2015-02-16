<?php
namespace phpGeoApi\utils;
use phpGeoApi as PGA;

/**
*   Static class with static methods for AES256 encoding/decoding. Require mcrypt module AND RINDJAEL 128 algorithm
*   @package phpGeoApi
*   @subpackage utils
*/
class AES256{
	/**
	*	Crypt this text
	*	@param string $text Text to crypt
	*	@param string $hex_key Hexadecimal key. 32 bytes (=64 hexa characters)
	*	@param string $hex_iv Hexadecimal IV. 16 bytes (=32 hexa characters)
	*	@param boolean $base64_mode Default false. Pass result in base 64 ? Usefull for passing in json for example.
	*	@result string Encrypted text (Eventually passed in base64)
	*/
	static public function crypt(string $text, $hex_key, $hex_iv, $base64_mode = false){

	}
	
	/**
	*	Decrypt this encrypted text
	*	@param string $text Text to decrypt
	*	@param string $hex_key Hexadecimal key. 32 bytes (=64 hexa characters)
	*	@param string $hex_iv Hexadecimal IV. 16 bytes (=32 hexa characters)
	*	@param boolean $base64_mode Default false. Is encrypted text passed in base 64 ?
	*	@result string Encrypted text (Eventually passed in base64)
	*/
	static public function decrypt($text, $hex_key, $hex_iv, $base64_mode = false){

	}
    
	/**
	*	Generate random hexa key for encryption
	*	@result string Hexadecimal key. 32 bytes (=64 hexa characters)
	*/
	static public function randKey(){
		
	}
	
	/**
	*	Generate random hexa iv for encryption
	*	@result string Hexadecimal iv. 16 bytes (=32 hexa characters)
	*/
	static public function randIV(){
		
	}
	
	/**
	*	Generate random hexa iv for encryption
	*	@result boolean Valid ?
	*/
	static public function validKey($hex_key){
		
	}
	
	static public function validIV($hex_iv){

	}
	
	static public function hex2bin($hexa_string){

	}
}