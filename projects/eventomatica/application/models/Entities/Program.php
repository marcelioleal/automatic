<?php

namespace Entities;

/**
 * Entities\Program
 *
 * @Table(name="program")
 * @Entity(repositoryClass="Mapper\Program")
 */
class Program
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
     * @var string $description
     *
     * @Column(name="description", type="string", length=100, nullable=true)
     */
    private $description;

    /**
     * @var Event
     *
     * @ManyToOne(targetEntity="Event")
     * @JoinColumns({
     *   @JoinColumn(name="eventId", referencedColumnName="id")
     * })
     */
    private $eventid;

    /**
     * @var Place
     *
     * @ManyToOne(targetEntity="Place")
     * @JoinColumns({
     *   @JoinColumn(name="placeId", referencedColumnName="id")
     * })
     */
    private $placeid;

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
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set eventid
     *
     * @param Event $eventid
     */
    public function setEventid(\Event $eventid)
    {
        $this->eventid = $eventid;
    }

    /**
     * Get eventid
     *
     * @return Event $eventid
     */
    public function getEventid()
    {
        return $this->eventid;
    }

    /**
     * Set placeid
     *
     * @param Place $placeid
     */
    public function setPlaceid(\Place $placeid)
    {
        $this->placeid = $placeid;
    }

    /**
     * Get placeid
     *
     * @return Place $placeid
     */
    public function getPlaceid()
    {
        return $this->placeid;
    }

}