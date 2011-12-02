<?php

namespace Util;

Class Enum {

	static function setValues(){
		$labels = array();
		$labels["KEY"]["VALUE"]       = 1;
		
		return $labels;
	}
	
	static function getKey($class, $key){
		$labels = array_change_key_case(Enum::setValues(),CASE_UPPER);
		$sub 	= array_change_key_case($labels[strtoupper($class)],CASE_UPPER);
		return $sub[strtoupper($key)];
	}
	
	static function getLabel($class, $value){
		$labels = Enum::setValues();
		$res = array_keys($labels[strtoupper($class)],strtoupper($value));
		return $res[0];
	}
	
	static function getListByClass($class){
		$labels = Enum::setValues();
		$vec =  array_flip($labels[strtoupper($class)]);
		foreach($vec as $key => $elem)
			$res[$key] = $elem;
		return $res;
	}
	
}
