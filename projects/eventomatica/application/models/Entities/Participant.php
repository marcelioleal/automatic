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

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set eventid
     *
     * @param integer $eventid
     */
    public function setEventid($eventid)
    {
        $this->eventid = $eventid;
    }

    /**
     * Get eventid
     *
     * @return integer $eventid
     */
    public function getEventid()
    {
        return $this->eventid;
    }

    /**
     * Set participantroleid
     *
     * @param Eventparticipantrole $participantroleid
     */
    public function setParticipantroleid(\Eventparticipantrole $participantroleid)
    {
        $this->participantroleid = $participantroleid;
    }

    /**
     * Get participantroleid
     *
     * @return Eventparticipantrole $participantroleid
     */
    public function getParticipantroleid()
    {
        return $this->participantroleid;
    }

    /**
     * Set personid
     *
     * @param Person $personid
     */
    public function setPersonid(\Person $personid)
    {
        $this->personid = $personid;
    }

    /**
     * Get personid
     *
     * @return Person $personid
     */
    public function getPersonid()
    {
        return $this->personid;
    }

}