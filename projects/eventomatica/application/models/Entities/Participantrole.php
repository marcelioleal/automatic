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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
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
     * Add eventid
     *
     * @param Event $eventid
     */
    public function addEventid(\Event $eventid)
    {
        $this->eventid[] = $eventid;
    }

    /**
     * Get eventid
     *
     * @return Doctrine\Common\Collections\Collection $eventid
     */
    public function getEventid()
    {
        return $this->eventid;
    }

}