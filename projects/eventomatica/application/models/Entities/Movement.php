<?php

namespace Entities;

/**
 * Entities\Movement
 *
 * @Table(name="movement")
 * @Entity(repositoryClass="Mapper\Movement")
 */
class Movement
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
     * @var decimal $value
     *
     * @Column(name="value", type="decimal", nullable=true)
     */
    private $value;

    /**
     * @var string $type
     *
     * @Column(name="type", type="string", length=5, nullable=true)
     */
    private $type;

    /**
     * @var date $payday
     *
     * @Column(name="payday", type="date", nullable=true)
     */
    private $payday;

    /**
     * @var smallint $status
     *
     * @Column(name="status", type="smallint", nullable=true)
     */
    private $status;

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
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param decimal $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return decimal $value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set payday
     *
     * @param date $payday
     */
    public function setPayday($payday)
    {
        $this->payday = $payday;
    }

    /**
     * Get payday
     *
     * @return date $payday
     */
    public function getPayday()
    {
        return $this->payday;
    }

    /**
     * Set status
     *
     * @param smallint $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return smallint $status
     */
    public function getStatus()
    {
        return $this->status;
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

}