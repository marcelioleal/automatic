<?php

/** @namespace */
namespace Mapper;

class MapperFactory
{

    public static function entityManager()
    {
        return \Zend\Registry::get("entitymanager");
    }

    public static function address()
    {
        return new Address(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Address'));
    }

    public static function contract()
    {
        return new Contract(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Contract'));
    }

    public static function country()
    {
        return new Country(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Country'));
    }

    public static function customer()
    {
        return new Customer(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Customer'));
    }

    public static function event()
    {
        return new Event(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Event'));
    }

    public static function movement()
    {
        return new Movement(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Movement'));
    }

    public static function paper()
    {
        return new Paper(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Paper'));
    }

    public static function participant()
    {
        return new Participant(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Participant'));
    }

    public static function participantrole()
    {
        return new Participantrole(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Participantrole'));
    }

    public static function person()
    {
        return new Person(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Person'));
    }

    public static function place()
    {
        return new Place(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Place'));
    }

    public static function presentation()
    {
        return new Presentation(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Presentation'));
    }

    public static function program()
    {
        return new Program(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Program'));
    }

    public static function province()
    {
        return new Province(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Province'));
    }

    public static function room()
    {
        return new Room(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Room'));
    }

    public static function town()
    {
        return new Town(self::entityManager(), self::entityManager()->getClassMetadata('Entities\Town'));
    }


}

