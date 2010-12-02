<?php

namespace Entities;

/**
 * Entities\Participant
 *
 * @Table(name="participant")
 * @Entity(repositoryClass="Mapper\Participant")
 */
class Participant
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
     * @var integer $eventid
     *
     * @Column(name="eventId", type="integer", nullable=false)
     */
    private $eventid;

    /**
     * @var Eventparticipantrole
     *
     * @ManyToOne(targetEntity="Eventparticipantrole")
     * @JoinColumns({
     *   @JoinColumn(name="participantRoleId", referencedColumnName="participantRoleId")
     * })
     */
    private $participantroleid;

    /**
     * @var Person
     *
     * @ManyToOne(targetEntity="Person")
     * @JoinColumns({
     *   @JoinColumn(name="personId", referencedColumnName="id")
     * })
     */
    private $personid;

}