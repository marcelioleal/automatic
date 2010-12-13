<?php

namespace Entities;

/**
 * Entities\Event
 *
 * @Table(name="event")
 * @Entity(repositoryClass="Mapper\Event")
 */
class Event
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
     * @var datetime $createdat
     *
     * @Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdat;

    /**
     * @var integer $type
     *
     * @Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * @var Participantrole
     *
     * @ManyToMany(targetEntity="Participantrole", inversedBy="eventid")
     * @JoinTable(name="eventparticipantrole",
     *   joinColumns={
     *     @JoinColumn(name="eventId", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="participantRoleId", referencedColumnName="id")
     *   }
     * )
     */
    private $participantroleid;

    /**
     * @var Customer
     *
     * @ManyToOne(targetEntity="Customer")
     * @JoinColumns({
     *   @JoinColumn(name="customerId", referencedColumnName="id")
     * })
     */
    private $customerid;

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
     * Set createdat
     *
     * @param datetime $createdat
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;
    }

    /**
     * Get createdat
     *
     * @return datetime $createdat
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set type
     *
     * @param integer $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return integer $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add participantroleid
     *
     * @param Participantrole $participantroleid
     */
    public function addParticipantroleid(\Participantrole $participantroleid)
    {
        $this->participantroleid[] = $participantroleid;
    }

    /**
     * Get participantroleid
     *
     * @return Doctrine\Common\Collections\Collection $participantroleid
     */
    public function getParticipantroleid()
    {
        return $this->participantroleid;
    }

    /**
     * Set customerid
     *
     * @param Customer $customerid
     */
    public function setCustomerid(\Customer $customerid)
    {
        $this->customerid = $customerid;
    }

    /**
     * Get customerid
     *
     * @return Customer $customerid
     */
    public function getCustomerid()
    {
        return $this->customerid;
    }

}