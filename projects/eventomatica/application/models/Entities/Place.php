<?php

namespace Entities;

/**
 * Entities\Place
 *
 * @Table(name="place")
 * @Entity(repositoryClass="Mapper\Place")
 */
class Place
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
     * @var Address
     *
     * @ManyToOne(targetEntity="Address")
     * @JoinColumns({
     *   @JoinColumn(name="addressId", referencedColumnName="id")
     * })
     */
    private $addressid;

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
     * Set addressid
     *
     * @param Address $addressid
     */
    public function setAddressid(\Address $addressid)
    {
        $this->addressid = $addressid;
    }

    /**
     * Get addressid
     *
     * @return Address $addressid
     */
    public function getAddressid()
    {
        return $this->addressid;
    }

}