<?php

namespace Entities;

/**
 * Entities\Participantrole
 *
 * @Table(name="participantrole")
 * @Entity(repositoryClass="Mapper\Participantrole")
 */
class Participantrole
{
    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $name
     *
     * @Column(name="name", type="string", length=20, nullable=true)
     */
    private $name;

    /**
     * @var string $description
     *
     * @Column(name="description", type="string", length=100, nullable=true)
     */
    private $description;

    /**
     * @var Event
     *
     * @ManyToMany(targetEntity="Event", mappedBy="participantroleid")
     */
    private $eventid;

}