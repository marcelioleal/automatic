<?php

namespace Util;

Class Message {
	
	static function get($class,$type){
		$message = array(
			"GENERAL"=>array(
				"SUCCESS"            =>"Opera&ccedil;&atilde;o Efetuada com Sucesso.",
				"GENERIC_ERROR"      =>"A Opera&ccedil;&atilde;o falhou.",
				"PAGE_NOT_FOUND"     =>"A P&aacute;gina n&atilde;o foi encontrada",
				"NOT_FOUND"          => "Nenhum resultado retornado."
				),
			"USER"=>array(
				"DUPLICATE_LOGIN"    => "Login duplicado, tente outro.",
				"NOT_FOUND"	         => "The user was not found.",
				"PASSWORD_MISMATCH"	 => "Password does not match."
				),
			"SECURITY"=>array(
				"NOT_MAY"            =>"Opera&ccedil;&atilde;o n&atilde;o permitida. Sua opera&ccedil;&atilde;o est&aacute; logada.",
				)				
		);

		return $message[$class][$type];
	}
}
