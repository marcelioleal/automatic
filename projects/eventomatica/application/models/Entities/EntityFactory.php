<?php

/** @namespace */
namespace Entities;

class EntityFactory
{

    public static function address($id, $street, $complement, $number, $postalcode)
    {
        $address = new Address;
        $address->setId($id);
        $address->setStreet($street);
        $address->setComplement($complement);
        $address->setNumber($number);
        $address->setPostalcode($postalcode);
        return $address;
    }

    public static function contract($id, $description, $value, $begin, $end, $createdat)
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

    public static function country($id, $name, $sigla)
    {
        $country = new Country;
        $country->setId($id);
        $country->setName($name);
        $country->setSigla($sigla);
        return $country;
    }

    public static function customer($id, $status, $begin, $end)
    {
        $customer = new Customer;
        $customer->setId($id);
        $customer->setStatus($status);
        $customer->setBegin($begin);
        $customer->setEnd($end);
        return $customer;
    }

    public static function event($id, $createdat, $type)
    {
        $event = new Event;
        $event->setId($id);
        $event->setCreatedat($createdat);
        $event->setType($type);
        return $event;
    }

    public static function movement($id, $value, $type, $payday, $status)
    {
        $movement = new Movement;
        $movement->setId($id);
        $movement->setValue($value);
        $movement->setType($type);
        $movement->setPayday($payday);
        $movement->setStatus($status);
        return $movement;
    }

    public static function paper($id, $title, $description)
    {
        $paper = new Paper;
        $paper->setId($id);
        $paper->setTitle($title);
        $paper->setDescription($description);
        return $paper;
    }

    public static function participant($id, $eventid)
    {
        $participant = new Participant;
        $participant->setId($id);
        $participant->setEventid($eventid);
        return $participant;
    }

    public static function participantrole($id, $name, $description)
    {
        $participantrole = new Participantrole;
        $participantrole->setId($id);
        $participantrole->setName($name);
        $participantrole->setDescription($description);
        return $participantrole;
    }

    public static function person($id, $type, $createdat, $status)
    {
        $person = new Person;
        $person->setId($id);
        $person->setType($type);
        $person->setCreatedat($createdat);
        $person->setStatus($status);
        return $person;
    }

    public static function place($id, $description, $type)
    {
        $place = new Place;
        $place->setId($id);
        $place->setDescription($description);
        $place->setType($type);
        return $place;
    }

    public static function presentation($id, $title, $description, $begin, $end)
    {
        $presentation = new Presentation;
        $presentation->setId($id);
        $presentation->setTitle($title);
        $presentation->setDescription($description);
        $presentation->setBegin($begin);
        $presentation->setEnd($end);
        return $presentation;
    }

    public static function program($id, $description)
    {
        $program = new Program;
        $program->setId($id);
        $program->setDescription($description);
        return $program;
    }

    public static function province($id, $name, $sigla)
    {
        $province = new Province;
        $province->setId($id);
        $province->setName($name);
        $province->setSigla($sigla);
        return $province;
    }

    public static function room($id, $description, $type)
    {
        $room = new Room;
        $room->setId($id);
        $room->setDescription($description);
        $room->setType($type);
        return $room;
    }

    public static function town($id, $name)
    {
        $town = new Town;
        $town->setId($id);
        $town->setName($name);
        return $town;
    }


}

