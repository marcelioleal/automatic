<?php
namespace Mapper;

class MapperFactory
{
	public static function EntityManager()
	{
		return \Zend\Registry::get("entitymanager");
	}
	
	public static function Address()
	{
		return new Address(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Address'));
	}
	
	public static function Contract()
	{
		return new Contract(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Contract'));
	}
	
	public static function Country()
	{
		return new Country(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Country'));
	}
	
	public static function Customer()
	{
		return new Customer(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Customer'));
	}
	
	public static function Event()
	{
		return new Event(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Event'));
	}
	
	public static function Movement()
	{
		return new Movement(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Movement'));
	}
	
	public static function Paper()
	{
		return new Paper(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Paper'));
	}
	
	public static function Participant()
	{
		return new Participant(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Participant'));
	}
	
	public static function Participantrole()
	{
		return new Participantrole(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Participantrole'));
	}
	
	public static function Person()
	{
		return new Person(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Person'));
	}
	
	public static function Place()
	{
		return new Place(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Place'));
	}
	
	public static function Presentation()
	{
		return new Presentation(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Presentation'));
	}
	
	public static function Program()
	{
		return new Program(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Program'));
	}
	
	public static function Province()
	{
		return new Province(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Province'));
	}
	
	public static function Room()
	{
		return new Room(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Room'));
	}
	
	public static function Town()
	{
		return new Town(self::EntityManager(), self::EntityManager()->getClassMetadata('Entities\Town'));
	}
	
		
}