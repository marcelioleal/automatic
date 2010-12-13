<?php

namespace Entities;

/**
 * Entities\Room
 *
 * @Table(name="room")
 * @Entity(repositoryClass="Mapper\Room")
 */
class Room
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
     * @Column(name="description", type="string", length=45, nullable=true)
     */
    private $description;

    /**
     * @var string $type
     *
     * @Column(name="type", type="string", length=45, nullable=true)
     */
    private $type;

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