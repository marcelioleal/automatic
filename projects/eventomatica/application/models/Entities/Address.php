<?php

namespace Entities;

/**
 * Entities\Address
 *
 * @Table(name="address")
 * @Entity(repositoryClass="Mapper\Address")
 */
class Address
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
     * @var string $street
     *
     * @Column(name="street", type="string", length=100, nullable=true)
     */
    private $street;

    /**
     * @var string $complement
     *
     * @Column(name="complement", type="string", length=100, nullable=true)
     */
    private $complement;

    /**
     * @var string $number
     *
     * @Column(name="number", type="string", length=5, nullable=true)
     */
    private $number;

    /**
     * @var string $postalcode
     *
     * @Column(name="postalCode", type="string", length=15, nullable=true)
     */
    private $postalcode;

    /**
     * @var Person
     *
     * @ManyToMany(targetEntity="Person", mappedBy="addressid")
     */
    private $personid;

    /**
     * @var Town
     *
     * @ManyToOne(targetEntity="Town")
     * @JoinColumns({
     *   @JoinColumn(name="townId", referencedColumnName="id")
     * })
     */
    private $townid;

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
     * Set street
     *
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * Get street
     *
     * @return string $street
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set complement
     *
     * @param string $complement
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;
    }

    /**
     * Get complement
     *
     * @return string $complement
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set number
     *
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * Get number
     *
     * @return string $number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set postalcode
     *
     * @param string $postalcode
     */
    public function setPostalcode($postalcode)
    {
        $this->postalcode = $postalcode;
    }

    /**
     * Get postalcode
     *
     * @return string $postalcode
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }

    /**
     * Add personid
     *
     * @param Person $personid
     */
    public function addPersonid(\Person $personid)
    {
        $this->personid[] = $personid;
    }

    /**
     * Get personid
     *
     * @return Doctrine\Common\Collections\Collection $personid
     */
    public function getPersonid()
    {
        return $this->personid;
    }

    /**
     * Set townid
     *
     * @param Town $townid
     */
    public function setTownid(\Town $townid)
    {
        $this->townid = $townid;
    }

    /**
     * Get townid
     *
     * @return Town $townid
     */
    public function getTownid()
    {
        return $this->townid;
    }

}