<?php
namespace Entities;

class EntityFactory
{
	public static function Address( $id, $street, $complement, $number, $postalcode )
	{
		$address = new Address;
		$address->setId($id);
		$address->setStreet($street);
		$address->setComplement($complement);
		$address->setNumber($number);
		$address->setPostalcode($postalcode);
		return $address;
	}
	
	public static function Contract( $id, $description, $value, $begin, $end, $createdat )
	{
		$contract = new Contract;
		$contract->setId($id);
		$contract->setDescription($description);
		$contract->setValue($value);
		$contract->setBegin($begin);
		$contract->setEnd($end);
		$contract->setCreatedat($createdat);
		return $contract;
	}
	
	public static function Country( $id, $name, $sigla )
	{
		$country = new Country;
		$country->setId($id);
		$country->setName($name);
		$country->setSigla($sigla);
		return $country;
	}
	
	public static function Customer( $id, $status, $begin, $end )
	{
		$customer = new Customer;
		$customer->setId($id);
		$customer->setStatus($status);
		$customer->setBegin($begin);
		$customer->setEnd($end);
		return $customer;
	}
	
	public static function Event( $id, $createdat, $type )
	{
		$event = new Event;
		$event->setId($id);
		$event->setCreatedat($createdat);
		$event->setType($type);
		return $event;
	}
	
	public static function Movement( $id, $value, $type, $payday, $status )
	{
		$movement = new Movement;
		$movement->setId($id);
		$movement->setValue($value);
		$movement->setType($type);
		$movement->setPayday($payday);
		$movement->setStatus($status);
		return $movement;
	}
	
	public static function Paper( $id, $title, $description )
	{
		$paper = new Paper;
		$paper->setId($id);
		$paper->setTitle($title);
		$paper->setDescription($description);
		return $paper;
	}
	
	public static function Participant( $id, $eventid )
	{
		$participant = new Participant;
		$participant->setId($id);
		$participant->setEventid($eventid);
		return $participant;
	}
	
	public static function Participantrole( $id, $name, $description )
	{
		$participantrole = new Participantrole;
		$participantrole->setId($id);
		$participantrole->setName($name);
		$participantrole->setDescription($description);
		return $participantrole;
	}
	
	public static function Person( $id, $type, $createdat, $status )
	{
		$person = new Person;
		$person->setId($id);
		$person->setType($type);
		$person->setCreatedat($createdat);
		$person->setStatus($status);
		return $person;
	}
	
	public static function Place( $id, $description, $type )
	{
		$place = new Place;
		$place->setId($id);
		$place->setDescription($description);
		$place->setType($type);
		return $place;
	}
	
	public static function Presentation( $id, $title, $description, $begin, $end )
	{
		$presentation = new Presentation;
		$presentation->setId($id);
		$presentation->setTitle($title);
		$presentation->setDescription($description);
		$presentation->setBegin($begin);
		$presentation->setEnd($end);
		return $presentation;
	}
	
	public static function Program( $id, $description )
	{
		$program = new Program;
		$program->setId($id);
		$program->setDescription($description);
		return $program;
	}
	
	public static function Province( $id, $name, $sigla )
	{
		$province = new Province;
		$province->setId($id);
		$province->setName($name);
		$province->setSigla($sigla);
		return $province;
	}
	
	public static function Room( $id, $description, $type )
	{
		$room = new Room;
		$room->setId($id);
		$room->setDescription($description);
		$room->setType($type);
		return $room;
	}
	
	public static function Town( $id, $name )
	{
		$town = new Town;
		$town->setId($id);
		$town->setName($name);
		return $town;
	}
	
	
}