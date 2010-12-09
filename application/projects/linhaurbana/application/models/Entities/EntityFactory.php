<?php
namespace Entities;

class EntityFactory
{
	public static function Linha( $id, $nome, $idSetran, $codSetran )
	{
		$linha = new Linha;
		$linha->setId($id);
		$linha->setNome($nome);
		$linha->setIdSetran($idSetran);
		$linha->setCodSetran($codSetran);
		return $linha;
	}
	
	public static function Rota( $id, $rota )
	{
		$rota = new Rota;
		$rota->setId($id);
		$rota->setRota($rota);
		return $rota;
	}
	
	public static function Via( $id, $nome )
	{
		$via = new Via;
		$via->setId($id);
		$via->setNome($nome);
		return $via;
	}
	
	
}