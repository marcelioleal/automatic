<?php
namespace Mapper;

class MapperFactory
{
	public static function EntityManager()
	{
		return \Zend\Registry::get("entitymanager");
	}
	
	public static function Linha()
	{
		return new Linha(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Linha'));
	}
	
	public static function Rota()
	{
		return new Rota(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Rota'));
	}
	
	public static function Via()
	{
		return new Via(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Via'));
	}
	
		
}